<?php

namespace Users\Files\Received;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../../ReceivedFiles/File/deleteOnReceiver.php';
    \ReceivedFiles\File\deleteOnReceiver($id_users);

    include_once __DIR__.'/../../../ReceivedFiles/deleteOnReceiver.php';
    \ReceivedFiles\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_files = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
