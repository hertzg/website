<?php

namespace Users\Files;

function delete ($mysqli, $file) {

    $id = $file->id_files;
    $id_users = $file->id_users;

    include_once __DIR__.'/../../Files/delete.php';
    \Files\delete($mysqli, $id);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, -$file->size);

    include_once __DIR__.'/../../Files/File/delete.php';
    \Files\File\delete($id_users, $id);

}
