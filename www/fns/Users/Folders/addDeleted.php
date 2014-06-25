<?php

namespace Users\Folders;

function addDeleted ($mysqli, $id_users, $folder) {

    $id_folders = $folder->id;
    $parent_id_folders = $folder->parent_id_folders;
    $name = $folder->name;
    $fnsDir = __DIR__.'/../..';

    if ($parent_id_folders) {
        include_once "$fnsDir/Folders/get.php";
        $parentFolder = \Folders\get($mysqli, $id_users, $parent_id_folders);
        if (!$parentFolder) $parent_id_folders = 0;
    }

    include_once "$fnsDir/Folders/getUniqueName.php";
    $name = \Folders\getUniqueName($mysqli,
        $id_users, $parent_id_folders, $name);

    include_once "$fnsDir/Folders/addDeleted.php";
    \Folders\addDeleted($mysqli, $id_folders, $id_users,
        $parent_id_folders, $name, $folder->insert_time, $folder->rename_time);

    $restore = function ($parent_id_folders, $restore) use ($mysqli, $id_users, $fnsDir) {

        include_once "$fnsDir/DeletedFolders/indexOnParent.php";
        $deletedFolders = \DeletedFolders\indexOnParent(
            $mysqli, $id_users, $parent_id_folders);

        foreach ($deletedFolders as $deletedFolder) {
            $id_folders = $deletedFolder->id_folders;
            \Folders\addDeleted($mysqli, $id_folders, $id_users,
                $parent_id_folders, $deletedFolder->name,
                $deletedFolder->insert_time, $deletedFolder->rename_time);
            $restore($id_folders, $restore);
        }

        include_once "$fnsDir/DeletedFiles/indexOnParent.php";
        $deletedFiles = \DeletedFiles\indexOnParent(
            $mysqli, $id_users, $parent_id_folders);

        if ($deletedFiles) {
            include_once __DIR__.'/../Files/addDeleted.php';
            foreach ($deletedFiles as $deletedFile) {
                \Users\Files\addDeleted($mysqli, $id_users, (object)[
                    'id' => $deletedFile->id_files,
                    'id_folders' => $parent_id_folders,
                    'name' => $deletedFile->name,
                    'size' => $deletedFile->size,
                    'insert_time' => $deletedFile->insert_time,
                    'rename_time' => $deletedFile->rename_time,
                ]);
            }
        }

    };
    $restore($id_folders, $restore);

}
