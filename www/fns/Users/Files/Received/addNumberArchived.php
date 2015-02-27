<?php

namespace Users\Files\Received;

function addNumberArchived ($mysqli, $id_users, $n) {
    $sql = 'update users set num_archived_received_files ='
        ." num_archived_received_files + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
