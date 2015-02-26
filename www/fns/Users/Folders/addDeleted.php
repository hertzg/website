<?php

namespace Users\Folders;

function addDeleted ($mysqli, $user, $folder) {

    $num_folders = 1;
    $id_folders = $folder->id;
    $id_users = $user->id_users;
    $parent_id_folders = $folder->parent_id_folders;
    $name = $folder->name;
    $fnsDir = __DIR__.'/../..';

    if ($parent_id_folders) {
        include_once "$fnsDir/Users/Folders/get.php";
        $parentFolder = \Users\Folders\get($mysqli, $user, $parent_id_folders);
        if (!$parentFolder) $parent_id_folders = 0;
    }

    include_once "$fnsDir/Folders/getUniqueName.php";
    $name = \Folders\getUniqueName($mysqli,
        $id_users, $parent_id_folders, $name);

    include_once "$fnsDir/Folders/addDeleted.php";
    \Folders\addDeleted($mysqli, $id_folders, $id_users,
        $parent_id_folders, $name, $folder->insert_time,
        $folder->rename_time, $folder->revision);

    $restore = function ($parent_id_folders, $restore) use ($mysqli,
        $user, $fnsDir, &$num_folders) {

        $id_users = $user->id_users;

        include_once "$fnsDir/DeletedFolders/indexOnParent.php";
        $deletedFolders = \DeletedFolders\indexOnParent(
            $mysqli, $id_users, $parent_id_folders);

        foreach ($deletedFolders as $deletedFolder) {
            $id_folders = $deletedFolder->id_folders;
            \Folders\addDeleted($mysqli, $id_folders, $id_users,
                $parent_id_folders, $deletedFolder->name,
                $deletedFolder->insert_time, $deletedFolder->rename_time,
                $deletedFolder->revision);
            $num_folders++;
            $restore($id_folders, $restore);
        }

        include_once "$fnsDir/DeletedFiles/indexOnParent.php";
        $deletedFiles = \DeletedFiles\indexOnParent(
            $mysqli, $id_users, $parent_id_folders);

        if ($deletedFiles) {
            include_once __DIR__.'/../Files/addDeleted.php';
            foreach ($deletedFiles as $deletedFile) {
                \Users\Files\addDeleted($mysqli, $user, (object)[
                    'id' => $deletedFile->id_files,
                    'id_folders' => $parent_id_folders,
                    'content_type' => $deletedFile->content_type,
                    'media_type' => $deletedFile->media_type,
                    'name' => $deletedFile->name,
                    'size' => $deletedFile->size,
                    'insert_time' => $deletedFile->insert_time,
                    'rename_time' => $deletedFile->rename_time,
                    'content_revision' => $deletedFile->content_revision,
                    'revision' => $deletedFile->revision,
                ]);
            }
        }

    };
    $restore($id_folders, $restore);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, $num_folders);

}
