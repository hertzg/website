<?php

namespace Users\Files\Received;

function import ($mysqli, $receivedFile, $parent_id, $insertApiKey = null) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedFile, $parent_id, $insertApiKey);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedFile);

    include_once __DIR__.'/../../../ReceivedFiles/File/delete.php';
    \ReceivedFiles\File\delete($receivedFile->receiver_id_users,
        $receivedFile->id);

    return $id;

}
