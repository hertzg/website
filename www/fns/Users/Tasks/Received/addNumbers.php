<?php

namespace Users\Tasks\Received;

function addNumbers ($mysqli, $id_users, $num, $num_archived) {
    $sql = 'update users set'
        ." num_received_tasks = num_received_tasks + $num,"
        .' num_archived_received_tasks'
        ." = num_archived_received_tasks + $num_archived"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
