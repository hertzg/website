<?php

namespace ReceivedFiles;

function deleteOnReceiver ($mysqli, $receiver_id_users) {

    $sql = 'select * from received_files'
        ." where receiver_id_users = $receiver_id_users";

    include_once __DIR__.'/../mysqli_query_object.php';
    $receivedFiles = mysqli_query_object($mysqli, $sql);

    if ($receivedFiles) {
        include_once __DIR__.'/File/delete.php';
        foreach ($receivedFiles as $receivedFile) {
            \ReceivedFiles\File\delete($receiver_id_users, $receivedFile->id);
        }
    }

    $sql = 'delete from received_files'
        ." where receiver_id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
