<?php

namespace Users\Folders\Received;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFolders/Committed/indexOnReceiver.php";
    $receivedFolders = \ReceivedFolders\Committed\indexOnReceiver($mysqli, $id_users);

    if ($receivedFolders) {
        include_once __DIR__.'/../../DeletedItems/addReceivedFolder.php';
        foreach ($receivedFolders as $receivedFolder) {
            \Users\DeletedItems\addReceivedFolder($mysqli, $receivedFolder);
        }
    }

    include_once "$fnsDir/ReceivedFolders/deleteOnReceiver.php";
    \ReceivedFolders\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_folders = 0,'
        .' num_archived_received_folders = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
