<?php

namespace Users\Files\Received;

function add ($mysqli, $user, $receiver_id_users,
    $name, $size, $filePath) {

    include_once __DIR__.'/../../../ReceivedFiles/add.php';
    $id = \ReceivedFiles\add($mysqli, $user->id_users, $user->username,
        $receiver_id_users, $name, $size, $filePath);

    include_once __DIR__.'/../../../ReceivedFiles/File/path.php';
    $storageFilePath = \ReceivedFiles\File\path($receiver_id_users, $id);
    copy($filePath, $storageFilePath);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

}
