<?php

namespace Users\Files\Received;

function delete ($mysqli, $receivedFile) {

    $id = $receivedFile->id;
    $id_users = $receivedFile->receiver_id_users;

    include_once __DIR__.'/../../../ReceivedFiles/delete.php';
    \ReceivedFiles\delete($mysqli, $id_users, $id);

    include_once __DIR__.'/../../../ReceivedFiles/File/delete.php';
    \ReceivedFiles\File\delete($id_users, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

}
