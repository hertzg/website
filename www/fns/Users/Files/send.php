<?php

namespace Users\Files;

function send ($mysqli, $user, $receiver_id_users, $file) {

    include_once __DIR__.'/../../Files/filePath.php';
    $filePath = \Files\filePath($user->id_users, $file->id_files);

    include_once __DIR__.'/Received/add.php';
    \Users\Files\Received\add($mysqli, $user, $receiver_id_users,
        $file->file_name, $file->file_size, $filePath);

}
