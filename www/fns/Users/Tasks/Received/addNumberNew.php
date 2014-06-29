<?php

namespace Users\Tasks\Received;

function addNumberNew ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_tasks = num_received_tasks + $n,"
        ." home_num_new_received_tasks = home_num_new_received_tasks + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
