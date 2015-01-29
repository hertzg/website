<?php

namespace Users\Files\Received;

function delete ($mysqli, $receivedFile, $apiKey = null) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedFile);

    include_once __DIR__.'/../../DeletedItems/addReceivedFile.php';
    \Users\DeletedItems\addReceivedFile($mysqli, $receivedFile, $apiKey);

}
