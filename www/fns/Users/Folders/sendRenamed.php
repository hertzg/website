<?php

namespace Users\Folders;

function sendRenamed ($mysqli, $user, $receiver_id_users, $folder, $name) {

    $id_users = $user->id_users;

    include_once __DIR__.'/../../ReceivedFolders/add.php';
    $id_received_folders = \ReceivedFolders\add($mysqli, $id_users,
        $user->username, $receiver_id_users, $name);

    $copy = function ($id, $parent_id, $copy) use ($mysqli,
        $id_received_folders, $id_users, $receiver_id_users) {

        include_once __DIR__.'/../../Files/indexInFolder.php';
        $files = \Files\indexInFolder($mysqli, $id);

        if ($files) {
            include_once __DIR__.'/Received/Files/add.php';
            include_once __DIR__.'/../../Files/File/path.php';
            foreach ($files as $file) {
                $path = \Files\File\path($id_users, $file->id_files);
                \Users\Folders\Received\Files\add($mysqli, $id_received_folders,
                    $receiver_id_users, $parent_id, $file->name,
                    $file->size, $path);
            }
        }

        include_once __DIR__.'/../../Folders/indexInFolder.php';
        $folders = \Folders\indexInFolder($mysqli, $id);

        if ($folders) {
            include_once __DIR__.'/../../ReceivedFolderSubfolders/add.php';
            foreach ($folders as $folder) {
                $id = \ReceivedFolderSubfolders\add($mysqli,
                    $id_received_folders, $receiver_id_users,
                    $parent_id, $folder->name);
                $copy($folder->id_folders, $id, $copy);
            }
        }

    };
    $copy($folder->id_folders, 0, $copy);

    include_once __DIR__.'/../../ReceivedFolders/commit.php';
    \ReceivedFolders\commit($mysqli, $id_received_folders);

    include_once __DIR__.'/Received/addNumberNew.php';
    \Users\Folders\Received\addNumberNew($mysqli, $receiver_id_users, 1);

}
