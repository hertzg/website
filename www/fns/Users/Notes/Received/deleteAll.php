<?php

namespace Users\Notes\Received;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../../ReceivedNotes/deleteOnReceiver.php';
    \ReceivedNotes\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_notes = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
