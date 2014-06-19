<?php

namespace Users\Folders\Received;

function addFile ($mysqli, $id, $id_users,
    $parent_id, $name, $size, $filePath) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFolderFiles/add.php";
    \ReceivedFolderFiles\add($mysqli, $id,
        $id_users, $parent_id, $name, $size);

    include_once "$fnsDir/ReceivedFolderFiles/File/path.php";
    $storagePath = \ReceivedFolderFiles\File\path($id_users, $id);
    copy($filePath, $storagePath);

}
