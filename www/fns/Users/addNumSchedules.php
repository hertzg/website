<?php

namespace Users;

function addNumSchedules ($mysqli, $id_users, $num_schedules) {
    $sql = "update users set num_schedules = num_schedules + $num_schedules"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
