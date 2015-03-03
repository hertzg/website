<?php

namespace Users\Events;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_events) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Events/indexOnUser.php";
    $events = \Events\indexOnUser($mysqli, $id_users);

    if ($events) {
        include_once __DIR__.'/../DeletedItems/addEvent.php';
        foreach ($events as $event) {
            \Users\DeletedItems\addEvent($mysqli, $event, $apiKey);
        }
    }

    include_once "$fnsDir/Events/deleteOnUser.php";
    \Events\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/user_time_today.php";
    $events_check_day = user_time_today($user);

    $sql = 'update users set num_events = 0,'
        .' num_events_today = 0, num_events_tomorrow = 0,'
        ." events_check_day = $events_check_day where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
