<?php

namespace Users\Files\Received;

function archive ($mysqli, $receivedFile) {
    include_once __DIR__.'/../../../ReceivedFiles/setArchived.php';
    \ReceivedFiles\setArchived($mysqli, $receivedFile->id, true);
}
