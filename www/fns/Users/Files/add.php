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
    copy($filePath, \Files\File\path($id_users, $id));

    include_once "$fnsDir/Files/commit.php";
    \Files\commit($mysqli, $id);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, $size, 1);

    return $id;

}
