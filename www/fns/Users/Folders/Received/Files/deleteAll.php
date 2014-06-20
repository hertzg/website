<?php

namespace Users\Folders\Received\Files;

function deleteAll ($mysqli, $id_received_folders) {

    $fnsDir = __DIR__.'/../../../..';

    include_once "$fnsDir/ReceivedFolderFiles/indexOnReceivedFolder.php";
    $files = \ReceivedFolderFiles\indexOnReceivedFolder(
        $mysqli, $id_received_folders);

    if ($files) {
        include_once "$fnsDir/ReceivedFolderFiles/File/delete.php";
        foreach ($files as $file) {
            \ReceivedFolderFiles\File\delete($file->id_users, $file->id);
        }
    }

    include_once "$fnsDir/ReceivedFolderFiles/deleteOnReceivedFolder.php";
    \ReceivedFolderFiles\deleteOnReceivedFolder($mysqli, $id_received_folders);

}
