<?php

namespace Users\Folders\Received;

function import ($mysqli, $receivedFolder, $parent_id) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedFolder, $parent_id);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedFolder);

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFolderSubfolders/deleteOnReceivedFolder.php";
    \ReceivedFolderSubfolders\deleteOnReceivedFolder($mysqli, $receivedFolder->id);

    include_once "$fnsDir/Users/Folders/Received/Files/deleteAll.php";
    \Users\Folders\Received\Files\deleteAll($mysqli, $receivedFolder->id);

    return $id;

}
