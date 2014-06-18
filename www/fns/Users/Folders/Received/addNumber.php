<?php

namespace Users\Folders\Received;

function addNumber ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_files = num_received_files + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
