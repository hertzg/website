<?php

namespace Users\Events;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Events/deleteOnUser.php";
    \Events\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/time_today.php";
    $time_today = time_today();
    $sql = 'update users set num_events = 0, num_events_today = 0,'
        ." num_events_tomorrow = 0, events_check_day = $time_today"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
