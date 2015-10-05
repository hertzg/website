<?php

namespace Users\Files;

function purge ($mysqli, $file) {

    include_once __DIR__.'/../../Files/delete.php';
    \Files\delete($mysqli, $file->id_files);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $file->id_users, -$file->size, -1);

}
