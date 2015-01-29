<?php

namespace Users\Folders\Received;

function delete ($mysqli, $receivedFolder, $apiKey = null) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedFolder);

    include_once __DIR__.'/../../DeletedItems/addReceivedFolder.php';
    \Users\DeletedItems\addReceivedFolder($mysqli, $receivedFolder, $apiKey);

}
