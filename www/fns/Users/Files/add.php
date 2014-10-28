<?php

namespace Users\Files;

function add ($mysqli, $id_users, $id_folders,
    $name, $filePath, $insertApiKey = null) {

    $size = filesize($filePath);
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Files/add.php";
    $id = \Files\add($mysqli, $id_users,
        $id_folders, $name, $size, $insertApiKey);

    include_once "$fnsDir/Files/File/path.php";
    $storagePath = \Files\File\path($id_users, $id);
    copy($filePath, $storagePath);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, $size);

    return $id;

}
