<?php

namespace Users\Files;

function add ($mysqli, $id_users, $id_folders, $name, $filePath) {

    $size = filesize($filePath);

    include_once __DIR__.'/../../Files/add.php';
    $id = \Files\add($mysqli, $id_users, $id_folders, $name, $size);

    include_once __DIR__.'/../../Files/File/path.php';
    $storagePath = \Files\File\path($id_users, $id);
    copy($filePath, $storagePath);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, $size);

    return $id;

}
