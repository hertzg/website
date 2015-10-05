<?php

namespace Users\Folders;

function addDeleted ($mysqli, $user, $folder) {

    $num_folders = 1;
    $id_folders = $folder->id;
    $id_users = $user->id_users;
    $parent_id = $folder->parent_id;
    $name = $folder->name;
    $fnsDir = __DIR__.'/../..';

    if ($parent_id) {
        include_once "$fnsDir/Folders/getOnUser.php";
        $parentFolder = \Folders\getOnUser($mysqli, $id_users, $parent_id);
        if (!$parentFolder) $parent_id = 0;
    }

    include_once "$fnsDir/Folders/getUniqueName.php";
    $name = \Folders\getUniqueName($mysqli, $id_users, $parent_id, $name);

    include_once "$fnsDir/Folders/addDeleted.php";
    \Folders\addDeleted($mysqli, $id_folders, $id_users, $parent_id, $name,
        $folder->insert_time, $folder->rename_time, $folder->revision);

    $restore = function ($parent_id, $restore) use ($mysqli,
        $user, $fnsDir, &$num_folders) {

        $id_users = $user->id_users;

        include_once "$fnsDir/DeletedFolders/indexOnParent.php";
        $deletedFolders = \DeletedFolders\indexOnParent(
            $mysqli, $id_users, $parent_id);

        foreach ($deletedFolders as $deletedFolder) {
            $id_folders = $deletedFolder->id_folders;
            \Folders\addDeleted($mysqli, $id_folders, $id_users,
                $parent_id, $deletedFolder->name, $deletedFolder->insert_time,
                $deletedFolder->rename_time, $deletedFolder->revision);
            $num_folders++;
            $restore($id_folders, $restore);
        }

        include_once "$fnsDir/DeletedFiles/indexOnParent.php";
        $deletedFiles = \DeletedFiles\indexOnParent(
            $mysqli, $id_users, $parent_id);

        if ($deletedFiles) {
            include_once __DIR__.'/../Files/addDeleted.php';
            foreach ($deletedFiles as $deletedFile) {
                \Users\Files\addDeleted($mysqli, $user, (object)[
                    'id' => $deletedFile->id_files,
                    'id_folders' => $parent_id,
                    'content_type' => $deletedFile->content_type,
                    'media_type' => $deletedFile->media_type,
                    'name' => $deletedFile->name,
                    'size' => $deletedFile->size,
                    'md5_sum' => $deletedFile->md5_sum,
                    'sha256_sum' => $deletedFile->sha256_sum,
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
