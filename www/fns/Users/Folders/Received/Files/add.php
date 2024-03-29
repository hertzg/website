<?php

namespace Users\Folders\Received\Files;

function add ($mysqli, $id_received_folders,
    $received_folder_name, $id_users, $parent_id, $name, $size, $filePath) {

    $fnsDir = __DIR__.'/../../../..';

    include_once "$fnsDir/ReceivedFolderFiles/add.php";
    $id = \ReceivedFolderFiles\add($mysqli, $id_received_folders,
        $received_folder_name, $id_users, $parent_id, $name, $size);

    include_once "$fnsDir/ReceivedFolderFiles/File/path.php";
    copy($filePath, \ReceivedFolderFiles\File\path($id_users, $id));

}
