<?php

namespace Users\Files\Received;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../../ReceivedFiles/indexOnReceiver.php';
    $receivedFiles = \ReceivedFiles\indexOnReceiver($mysqli, $id_users);

    if ($receivedFiles) {
        include_once __DIR__.'/../../../ReceivedFiles/File/delete.php';
        foreach ($receivedFiles as $receivedFile) {
            \ReceivedFiles\File\delete($id_users, $receivedFile->id);
        }
    }

    include_once __DIR__.'/../../../ReceivedFiles/deleteOnReceiver.php';
    \ReceivedFiles\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_files = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
