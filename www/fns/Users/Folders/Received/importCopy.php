<?php

namespace Users\Folders\Received;

function importCopy ($mysqli,
    $receivedFolder, $parent_id, $insertApiKey = null) {

    $id_users = $receivedFolder->receiver_id_users;
    $name = $receivedFolder->name;

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/Folders/getUniqueName.php";
    $name = \Folders\getUniqueName($mysqli, $id_users, $parent_id, $name);

    include_once "$fnsDir/Folders/add.php";
    $id_folders = \Folders\add($mysqli,
        $id_users, $parent_id, $name, $insertApiKey);

    $import = function ($parent_id, $parent_id_folders, $import) use ($mysqli,
        $receivedFolder, $id_users, $fnsDir, $insertApiKey) {

        include_once "$fnsDir/ReceivedFolderSubfolders/indexOnParent.php";
        $subfolders = \ReceivedFolderSubfolders\indexOnParent(
            $mysqli, $receivedFolder->id, $parent_id);

        foreach ($subfolders as $subfolder) {
            $id_folders = \Folders\add($mysqli, $id_users,
                $parent_id_folders, $subfolder->name, $insertApiKey);
            $import($subfolder->id, $id_folders, $import);
        }

        include_once "$fnsDir/ReceivedFolderFiles/indexOnParent.php";
        $files = \ReceivedFolderFiles\indexOnParent(
            $mysqli, $receivedFolder->id, $parent_id);

        if ($files) {
            include_once __DIR__.'/../../Files/add.php';
            include_once "$fnsDir/ReceivedFolderFiles/File/path.php";
            foreach ($files as $file) {
                $filePath = \ReceivedFolderFiles\File\path(
                    $id_users, $file->id);
                \Users\Files\add($mysqli, $id_users,
                    $parent_id_folders, $file->name, $filePath, $insertApiKey);
            }
        }

    };
    $import(0, $id_folders, $import);

    return $id_folders;

}
