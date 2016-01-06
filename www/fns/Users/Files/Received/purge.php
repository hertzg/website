<?php

namespace Users\Files\Received;

function purge ($mysqli, $receivedFile) {

    include_once __DIR__.'/../../../ReceivedFiles/delete.php';
    \ReceivedFiles\delete($mysqli, $receivedFile->id);

    $id_users = $receivedFile->receiver_id_users;

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $id_users, -1, $receivedFile->archived ? -1 : 0);

}
