<?php

namespace Users\Files\Received;

function purge ($mysqli, $receivedFile) {

    include_once __DIR__.'/../../../ReceivedFiles/delete.php';
    \ReceivedFiles\delete($mysqli, $id_users, $receivedFile->id);

    $id_users = $receivedFile->receiver_id_users;

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    if ($receivedFile->archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $id_users, -1);
    }

}
