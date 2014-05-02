<?php

namespace Users\Schedules;

function clearNumber ($mysqli, $id_users) {
    include_once __DIR__.'/../../day_today.php';
    $day_today = day_today();
    $sql = 'update users set num_schedules = 0, num_schedules_today = 0,'
        ." num_schedules_tomorrow = 0, schedules_check_day = $day_today"
        ." where id_users = $id_users";
    $mysqli->query($sql);
}
