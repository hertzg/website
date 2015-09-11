<?php

namespace Users\Files;

function editContent ($mysqli, $file, $filesize, $md5_sum, $sha256_sum) {

    include_once __DIR__.'/../../Files/editContent.php';
    \Files\editContent($mysqli, $file->id_files,
        $filesize, $md5_sum, $sha256_sum);

    $storageIncrement = $filesize - $file->size;
    if ($storageIncrement) {
        include_once __DIR__.'/../addStorageUsed.php';
        \Users\addStorageUsed($mysqli, $file->id_users, $storageIncrement);
    }

}
