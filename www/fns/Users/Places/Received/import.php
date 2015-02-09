<?php

namespace Users\Places\Received;

function import ($mysqli, $receivedPlace, $insertApiKey = null) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedPlace, $insertApiKey);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedPlace);

    return $id;

}
