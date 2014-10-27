<?php

namespace Users\Schedules;

function deleteAll ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Schedules/deleteOnUser.php";
    \Schedules\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/ScheduleTags/deleteOnUser.php";
    \ScheduleTags\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/user_day.php";
    $day = user_day($user);

    $sql = 'update users set num_schedules = 0, num_schedules_today = 0,'
        ." num_schedules_tomorrow = 0, schedules_check_day = $day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
