<?php

namespace Users\Folders;

function delete ($mysqli, $folder) {

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
                $ids[] = $folder->id_folders;
                $parent_ids[] = \DeletedFolders\add($mysqli,
                    $id_deleted_items, $parent_id, $folder->name,
                    $folder->insert_time, $folder->rename_time);
            }
        }

        include_once __DIR__.'/../../Files/indexInFolder.php';
        $files = \Files\indexInFolder($mysqli, $id);

        if ($files) {
            include_once __DIR__.'/../Files/purge.php';
            include_once __DIR__.'/../../Files/File/delete.php';
            foreach ($files as $file) {
                \Users\Files\purge($mysqli, $file);
                \Files\File\delete($file->id_users, $file->id_files);
            }
        }

    }

}
