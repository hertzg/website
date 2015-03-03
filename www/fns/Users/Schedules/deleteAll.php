<?php

namespace Users\Schedules;

function deleteAll ($mysqli, $user) {

    if (!$user->num_schedules) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Schedules/deleteOnUser.php";
    \Schedules\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/ScheduleTags/deleteOnUser.php";
    \ScheduleTags\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/user_time_today.php";
    $schedules_check_day = user_time_today($user);

    $sql = 'update users set num_schedules = 0,'
        .' num_schedules_today = 0, num_schedules_tomorrow = 0,'
        ." schedules_check_day = $schedules_check_day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
