<?php

namespace Users\Folders\Received;

function delete ($mysqli, $receivedFolder, $apiKey = null) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedFolder);

    $id = $receivedFolder->id;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFolderFiles/setDeletedOnFolder.php";
    \ReceivedFolderFiles\setDeletedOnFolder($mysqli, $id, true);

    include_once "$fnsDir/ReceivedFolderSubfolders/setDeletedOnFolder.php";
    \ReceivedFolderSubfolders\setDeletedOnFolder($mysqli, $id, true);

    include_once "$fnsDir/Users/DeletedItems/addReceivedFolder.php";
    \Users\DeletedItems\addReceivedFolder($mysqli, $receivedFolder, $apiKey);

}
