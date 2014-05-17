<?php

namespace Users\Files\Received;

function add ($mysqli, $user, $receiver_id_users,
    $name, $file_size, $filePath) {

    include_once __DIR__.'/../../../ReceivedFiles/add.php';
    \ReceivedFiles\add($mysqli, $user->id_users, $user->username,
        $receiver_id_users, $name, $file_size, $filePath);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

}
