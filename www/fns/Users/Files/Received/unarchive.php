<?php

namespace Users\Files\Received;

function unarchive ($mysqli, $receivedFile) {

    if (!$receivedFile->archived) return;

    include_once __DIR__.'/../../../ReceivedFiles/setArchived.php';
    \ReceivedFiles\setArchived($mysqli, $receivedFile->id, false);

    include_once __DIR__.'/addNumberArchived.php';
    addNumberArchived($mysqli, $receivedFile->receiver_id_users, -1);

}
