<?php

namespace Users\Folders;

function delete ($mysqli, $folder) {

    $id_users = $folder->id_users;

    include_once __DIR__.'/../DeletedItems/addFolder.php';
    $id_deleted_items = \Users\DeletedItems\addFolder($mysqli, $folder);

    $ids = [$folder->id_folders];
    while ($ids) {

        $id = array_shift($ids);

        include_once __DIR__.'/../../Folders/delete.php';
        \Folders\delete($mysqli, $id);

        include_once __DIR__.'/../../Folders/indexInFolder.php';
        $folders = \Folders\indexInFolder($mysqli, $id);

        if ($folders) {
            include_once __DIR__.'/../../DeletedFolders/add.php';
            foreach ($folders as $folder) {
                $id_folders = $folder->id_folders;
                $ids[] = $id_folders;
                \DeletedFolders\add($mysqli, $id_deleted_items,
                    $id_folders, $id, $id_users, $folder->name,
                    $folder->insert_time, $folder->rename_time);
            }
        }

        include_once __DIR__.'/../../Files/indexInFolder.php';
        $files = \Files\indexInFolder($mysqli, $id);

        if ($files) {
            include_once __DIR__.'/../Files/purge.php';
            include_once __DIR__.'/../../DeletedFiles/add.php';
            foreach ($files as $file) {
                $id_files = $file->id_files;
                \Users\Files\purge($mysqli, $file);
                \DeletedFiles\add($mysqli, $id_deleted_items, $id_files, $id,
                    $id_users, $file->content_type, $file->media_type,
                    $file->name, $file->size, $file->insert_time,
                    $file->rename_time);
            }
        }

    }

}
