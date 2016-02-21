<?php

namespace Users\Folders\Received;

function clearNumberNew ($mysqli, $user) {
    $user->home_num_new_received_folders = 0;
    $sql = 'update users set home_num_new_received_folders = 0'
        ." where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
