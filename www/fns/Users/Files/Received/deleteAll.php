<?php

namespace Users\Files\Received;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFiles/Committed/indexOnReceiver.php";
    $receivedFiles = \ReceivedFiles\Committed\indexOnReceiver(
        $mysqli, $id_users);

    if ($receivedFiles) {
        include_once __DIR__.'/../../DeletedItems/addReceivedFile.php';
        foreach ($receivedFiles as $receivedFile) {
            \Users\DeletedItems\addReceivedFile($mysqli, $receivedFile);
        }
    }

    include_once "$fnsDir/ReceivedFiles/deleteOnReceiver.php";
    \ReceivedFiles\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_files = 0,'
        .' num_archived_received_files = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
