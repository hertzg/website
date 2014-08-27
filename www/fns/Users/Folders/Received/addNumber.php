<?php

namespace Users\Folders\Received;

function addNumber ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_folders = num_received_folders + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
