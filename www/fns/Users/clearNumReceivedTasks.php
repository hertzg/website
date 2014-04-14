<?php

namespace Users;

function clearNumReceivedTasks ($mysqli, $id_users) {
    $sql = 'update users set num_received_tasks = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
