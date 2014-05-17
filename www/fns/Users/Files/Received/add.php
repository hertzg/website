<?php

namespace Users\Files\Received;

function add ($mysqli, $user, $receiver_id_users, $file) {

    $id_users = $user->id_users;

    include_once __DIR__.'/../../../Files/filePath.php';
    $filePath = \Files\filePath($id_users, $file->id_files);

    include_once __DIR__.'/../../../ReceivedFiles/add.php';
    \ReceivedFiles\add($mysqli, $id_users, $user->username,
        $receiver_id_users, $file->file_name, $file->file_size, $filePath);

    include_once __DIR__.'/../../../Users/addNumReceivedFiles.php';
    \Users\addNumReceivedFiles($mysqli, $receiver_id_users, 1);

}
