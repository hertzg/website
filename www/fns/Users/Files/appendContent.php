<?php

namespace Users\Files;

function appendContent ($mysqli, $file, $filePath) {

    $content = file_get_contents($filePath);
    $size = filesize($filePath);
    $id = $file->id_files;
    $id_users = $file->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Files/editContent.php";
    \Files\editContent($mysqli, $id, $file->size + $size);

    include_once "$fnsDir/Files/File/path.php";
    $storagePath = \Files\File\path($id_users, $id);
    file_put_contents($storagePath, $content, FILE_APPEND);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, $size);

    return $id;

}
