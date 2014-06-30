<?php

namespace Users\Folders\Received;

function clearNumberNew ($mysqli, $id_users) {
    $sql = 'update users set home_num_new_received_folders = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
