<?php

namespace Users\Folders;

function send ($mysqli, $user, $receiver_id_users, $folder) {

    $id_users = $user->id_users;

    include_once __DIR__.'/../../ReceivedFolders/add.php';
    $id_received_folders = \ReceivedFolders\add($mysqli, $id_users,
        $user->username, $receiver_id_users, $folder->name);

    include_once __DIR__.'/Received/addNumber.php';
    \Users\Folders\Received\addNumber($mysqli, $id_users, 1);

    $copy = function ($id, $parent_id, $copy) use ($mysqli, $id_received_folders, $id_users) {

        include_once __DIR__.'/../../Files/indexInFolder.php';
        $files = \Files\indexInFolder($mysqli, $id);

        if ($files) {
            include_once __DIR__.'/../../ReceivedFolderFiles/add.php';
            foreach ($files as $file) {
                \ReceivedFolderFiles\add($mysqli, $id_received_folders,
                    $id_users, $parent_id, $file->name, $file->size);
            }
        }

        include_once __DIR__.'/../../Folders/indexInFolder.php';
        $folders = \Folders\indexInFolder($mysqli, $id);

        if ($folders) {
            include_once __DIR__.'/../../ReceivedFolderSubfolders/add.php';
            foreach ($folders as $folder) {
                $id = \ReceivedFolderSubfolders\add($mysqli,
                    $id_received_folders, $id_users, $parent_id, $folder->name);
                $copy($folder->id_folders, $id, $copy);
            }
        }

    };
    $copy($folder->id_folders, 0, $copy);

}
