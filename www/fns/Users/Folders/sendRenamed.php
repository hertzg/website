<?php

namespace Users\Folders;

function sendRenamed ($mysqli, $user, $receiver_id_users, $folder, $name) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/ReceivedFolders/add.php";
    $id_received_folders = \ReceivedFolders\add($mysqli, null,
        $user->id_users, $user->username, $receiver_id_users, $name);

    $copy = function ($id, $parent_id, $copy) use ($mysqli,
        $id_received_folders, $name, $user, $receiver_id_users, $fnsDir) {

        include_once "$fnsDir/Users/Files/index.php";
        $files = \Users\Files\index($mysqli, $user, $id);

        if ($files) {
            include_once __DIR__.'/Received/Files/add.php';
            include_once "$fnsDir/Files/File/path.php";
            foreach ($files as $file) {
                $path = \Files\File\path($user->id_users, $file->id_files);
                \Users\Folders\Received\Files\add($mysqli, $id_received_folders,
                    $name, $receiver_id_users, $parent_id, $file->name,
                    $file->size, $path);
            }
        }

        include_once "$fnsDir/Folders/indexInFolder.php";
        $folders = \Folders\indexInFolder($mysqli, $id);

        if ($folders) {
            include_once "$fnsDir/ReceivedFolderSubfolders/add.php";
            foreach ($folders as $folder) {
                $id = \ReceivedFolderSubfolders\add($mysqli,
                    $id_received_folders, $name, $receiver_id_users,
                    $parent_id, $folder->name);
                $copy($folder->id_folders, $id, $copy);
            }
        }

    };
    $copy($folder->id_folders, 0, $copy);

    include_once "$fnsDir/ReceivedFolders/commit.php";
    \ReceivedFolders\commit($mysqli, $id_received_folders);

    $sql = 'update users set num_received_folders = num_received_folders + 1,'
        .' home_num_new_received_folders = home_num_new_received_folders + 1'
        ." where id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
