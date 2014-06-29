<?php

namespace Users\Files\Received;

function addNumberNew ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_files = num_received_files + $n,"
        ." home_num_new_received_files = home_num_new_received_files + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
