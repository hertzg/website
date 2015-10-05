<?php

namespace Users\Folders;

function delete ($mysqli, $user, $folder, $apiKey = null) {

    $num_folders = 0;
    $id_users = $folder->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once __DIR__.'/../DeletedItems/addFolder.php';
    $id_deleted_items = \Users\DeletedItems\addFolder(
        $mysqli, $folder, $apiKey);

    $ids = [$folder->id_folders];
    while ($ids) {

        $id = array_shift($ids);

        include_once "$fnsDir/Folders/delete.php";
        \Folders\delete($mysqli, $id);

        $num_folders++;

        include_once "$fnsDir/Folders/indexInFolder.php";
        $folders = \Folders\indexInFolder($mysqli, $id);

        if ($folders) {
            include_once "$fnsDir/DeletedFolders/add.php";
            foreach ($folders as $folder) {
                $id_folders = $folder->id_folders;
                $ids[] = $id_folders;
                \DeletedFolders\add($mysqli, $id_deleted_items, $id_folders,
                    $id, $id_users, $folder->name, $folder->insert_time,
                    $folder->rename_time, $folder->revision);
            }
        }

        include_once "$fnsDir/Users/Files/index.php";
        $files = \Users\Files\index($mysqli, $user, $id);

        if ($files) {
            include_once __DIR__.'/../Files/purge.php';
            include_once "$fnsDir/DeletedFiles/add.php";
            foreach ($files as $file) {
                $id_files = $file->id_files;
                \Users\Files\purge($mysqli, $file);
                \DeletedFiles\add($mysqli, $id_deleted_items, $id_files, $id,
                    $id_users, $file->content_type, $file->media_type,
                    $file->name, $file->size, $file->insert_time,
                    $file->rename_time, $file->content_revision,
                    $file->revision);
            }
        }

    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -$num_folders);

}
