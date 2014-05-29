<?php

namespace Users\Files\Received;

function unarchive ($mysqli, $receivedFile) {
    include_once __DIR__.'/../../../ReceivedFiles/setArchived.php';
    \ReceivedFiles\setArchived($mysqli, $receivedFile->id, false);
}
