<?php

namespace Users\Schedules;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Schedules/deleteOnUser.php";
    \Schedules\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/day_today.php";
    $day_today = day_today();

    $sql = 'update users set num_schedules = 0, num_schedules_today = 0,'
        ." num_schedules_tomorrow = 0, schedules_check_day = $day_today"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
