<?php

namespace Users\Tasks\Received;

function import ($mysqli, $receivedTask) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedTask);

    include_once __DIR__.'/delete.php';
    delete($mysqli, $receivedTask);

    return $id;

}
