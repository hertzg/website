<?php

namespace Users\Tasks\Received;

function addNumber ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_tasks = num_received_tasks + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
