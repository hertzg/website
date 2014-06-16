<?php

namespace Users\Notes\Received;

function import ($mysqli, $receivedNote) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedNote);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedNote);

    return $id;

}
