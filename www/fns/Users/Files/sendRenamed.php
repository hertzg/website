<?php

namespace Users\Files;

function sendRenamed ($mysqli, $user, $receiver_id_users, $file, $name) {

    include_once __DIR__.'/../../Files/File/path.php';
    $filePath = \Files\File\path($user->id_users, $file->id_files);

    include_once __DIR__.'/Received/add.php';
    Received\add($mysqli, $user, $receiver_id_users,
        $name, $file->size, $filePath);

}
