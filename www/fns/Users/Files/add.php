<?php

namespace Users\Files;

function add ($mysqli, $id_users, $id_folders, $name, $sourcePath) {

    $file_size = filesize($sourcePath);

    include_once __DIR__.'/../../Files/add.php';
    $id = \Files\add($mysqli, $id_users, $id_folders,
        $name, $file_size, $sourcePath);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, $file_size);

    return $id;

}
