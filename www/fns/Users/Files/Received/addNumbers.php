<?php

namespace Users\Files\Received;

function addNumbers ($mysqli, $id_users, $num, $num_archived) {
    $sql = 'update users set'
        ." num_received_files = num_received_files + $num,"
        .' num_archived_received_files'
        ." = num_archived_received_files + $num_archived"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
