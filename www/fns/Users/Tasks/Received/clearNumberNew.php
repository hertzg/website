<?php

namespace Users\Tasks\Received;

function clearNumberNew ($mysqli, $user) {
    $user->home_num_new_received_tasks = 0;
    $sql = 'update users set home_num_new_received_tasks = 0'
        ." where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
