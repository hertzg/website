<?php

namespace Users;

function clearNumReceivedNotes ($mysqli, $id_users) {
    $sql = 'update users set num_received_notes = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
