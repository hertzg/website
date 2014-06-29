<?php

namespace Users\Folders\Received;

function addNumberNew ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_folders = num_received_folders + $n,"
        ." home_num_new_received_folders = home_num_new_received_folders + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
