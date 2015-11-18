<?php

namespace Users\Schedules\Received;

function addNumberNew ($mysqli, $id_users, $n) {
    $sql = 'update users set'
        ." num_received_schedules = num_received_schedules + $n,"
        .' home_num_new_received_schedules'
        ." = home_num_new_received_schedules + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
