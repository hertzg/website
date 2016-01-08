<?php

namespace Users\Folders\Received;

function addNumbers ($mysqli, $id_users, $num, $num_archived) {
    $sql = 'update users set'
        ." num_received_folders = num_received_folders + $num,"
        .' num_archived_received_folders'
        ." = num_archived_received_folders + $num_archived"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
