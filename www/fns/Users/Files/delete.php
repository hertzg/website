<?php

namespace Users\Files;

function delete ($mysqli, $file) {

    include_once __DIR__.'/../../Files/delete.php';
    \Files\delete($mysqli, $file->id_files);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $file->id_users, -$file->size);

    include_once __DIR__.'/../DeletedItems/addFile.php';
    \Users\DeletedItems\addFile($mysqli, $file);

}
