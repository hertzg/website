<?php

namespace Users\Files;

function editContent ($mysqli, $file, $filesize) {

    include_once __DIR__.'/../../Files/editContent.php';
    \Files\editContent($mysqli, $file->id_files, $filesize);

    $storageIncrement = $filesize - $file->size;
    if ($storageIncrement) {
        include_once __DIR__.'/../addStorageUsed.php';
        \Users\addStorageUsed($mysqli, $file->id_users, $storageIncrement);
    }

}
