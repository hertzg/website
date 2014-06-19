<?php

namespace Users\Folders;

function delete ($mysqli, $folder) {

    $id_users = $folder->id_users;

    include_once __DIR__.'/../DeletedItems/addFolder.php';
    $id_deleted_items = \Users\DeletedItems\addFolder($mysqli, $folder);

    $ids = [$folder->id_folders];
    $parent_ids = [0];
    while ($ids) {

        $id = array_shift($ids);
        $parent_id = array_shift($parent_ids);

        include_once __DIR__.'/../../Folders/delete.php';
        \Folders\delete($mysqli, $id);

        include_once __DIR__.'/../../Folders/indexInFolder.php';
        $folders = \Folders\indexInFolder($mysqli, $id);

        if ($folders) {
            include_once __DIR__.'/../../DeletedFolders/add.php';
            foreach ($folders as $folder) {
                $id_folders = $folder->id_folders;
                $ids[] = $id_folders;
                $parent_ids[] = \DeletedFolders\add($mysqli,
                    $id_deleted_items, $parent_id, $id_folders, $id, $id_users,
                    $folder->name, $folder->insert_time, $folder->rename_time);
            }
        }

        include_once __DIR__.'/../../Files/indexInFolder.php';
        $files = \Files\indexInFolder($mysqli, $id);

        if ($files) {
            include_once __DIR__.'/../Files/purge.php';
            include_once __DIR__.'/../../Files/File/delete.php';
            include_once __DIR__.'/../../DeletedFiles/add.php';
            foreach ($files as $file) {
                $id_files = $file->id_files;
                \Users\Files\purge($mysqli, $file);
                \Files\File\delete($id_users, $id_files);
                \DeletedFiles\add($mysqli, $id_deleted_items, $parent_id,
                    $id_files, $id, $id_users, $file->name,
                    $file->size, $file->insert_time, $file->rename_time);
            }
        }

    }

}
