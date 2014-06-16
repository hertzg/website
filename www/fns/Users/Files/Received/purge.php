<?php

namespace Users\Files\Received;

function purge ($mysqli, $receivedFile) {

    $id_users = $receivedFile->receiver_id_users;

    include_once __DIR__.'/../../../ReceivedFiles/delete.php';
    \ReceivedFiles\delete($mysqli, $id_users, $receivedFile->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

}
