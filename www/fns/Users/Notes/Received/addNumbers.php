<?php

namespace Users\Notes\Received;

function addNumbers ($mysqli, $id_users, $num, $num_archived) {
    $sql = 'update users set'
        ." num_received_notes = num_received_notes + $num,"
        .' num_archived_received_notes'
        ." = num_archived_received_notes + $num_archived"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
