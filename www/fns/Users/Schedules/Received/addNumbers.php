<?php

namespace Users\Schedules\Received;

function addNumbers ($mysqli, $id_users, $num, $num_archived) {
    $sql = 'update users set'
        ." num_received_schedules = num_received_schedules + $num,"
        .' num_archived_received_schedules'
        ." = num_archived_received_schedules + $num_archived"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
