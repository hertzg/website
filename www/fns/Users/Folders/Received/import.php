<?php

namespace Users\Folders\Received;

function import ($mysqli, $receivedFolder, $parent_id) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedFolder, $parent_id);

    include_once __DIR__.'/delete.php';
    delete($mysqli, $receivedFolder);

    return $id;

}
