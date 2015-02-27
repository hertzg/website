<?php

namespace Users\Places\Received;

function addNumberArchived ($mysqli, $id_users, $n) {
    $sql = 'update users set num_archived_received_places ='
        ." num_archived_received_places + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
