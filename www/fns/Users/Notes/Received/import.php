<?php

namespace Users\Notes\Received;

function import ($mysqli, $receivedNote, $insertApiKey = null) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedNote, $insertApiKey);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedNote);

    return $id;

}
