<?php

namespace Users\Notes\Received;

function import ($mysqli, $receivedNote,
    $password_protect, $encryption_key, $insertApiKey = null) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedNote,
        $password_protect, $encryption_key, $insertApiKey);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedNote);

    return $id;

}
