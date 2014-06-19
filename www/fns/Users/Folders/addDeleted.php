<?php

namespace Users\Folders;

function addDeleted ($mysqli, $id_users, $data) {

    $id_folders = $data->id;

    include_once __DIR__.'/../../Folders/addDeleted.php';
    \Folders\addDeleted($mysqli, $id_folders, $id_users,
        $data->parent_id_folders, $data->name,
        $data->insert_time, $data->rename_time);

    $restore = function ($id_folders, $parent_id, $restore) use ($mysqli, $id_users) {

        include_once __DIR__.'/../../DeletedFolders/indexOnParent.php';
        $deletedFolders = \DeletedFolders\indexOnParent(
            $mysqli, $id_users, $parent_id);

        foreach ($deletedFolders as $deletedFolder) {
            $id_folders = $deletedFolder->id_folders;
            \Folders\addDeleted($mysqli, $id_folders, $id_users,
                $deletedFolder->parent_id_folders, $deletedFolder->name,
                $deletedFolder->insert_time, $deletedFolder->rename_time);
            $restore($id_folders, $deletedFolder->id, $restore);
        }

    };
    $restore($id_folders, 0, $restore);

}
