<?php

namespace Users\Tasks\Received;

function import ($mysqli, $user, $receivedTask, $insertApiKey = null) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $user, $receivedTask, $insertApiKey);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedTask);

    return $id;

}
