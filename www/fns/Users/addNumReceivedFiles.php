<?php

namespace Users;

function addNumReceivedFiles ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_files = num_received_files + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql);
}
