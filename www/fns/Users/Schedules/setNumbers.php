<?php

namespace Users\Schedules;

function setNumbers ($mysqli, $id_users, $num_schedules_today,
    $num_schedules_tomorrow, $schedules_check_day) {

    $sql = "update users set num_schedules_today = $num_schedules_today,"
        ." num_schedules_tomorrow = $num_schedules_tomorrow,"
        ." schedules_check_day = $schedules_check_day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
