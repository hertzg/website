<?php

namespace Users\Files\Received;

function import ($mysqli, $receivedFile, $parent_id) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedFile, $parent_id);

    include_once __DIR__.'/delete.php';
    delete($mysqli, $receivedFile);

    return $id;

}
