<?php

namespace Users\Files;

function delete ($mysqli, $file) {

    $id_users = $file->id_users;

    include_once __DIR__.'/../../Files/delete.php';
    \Files\delete($mysqli, $id_users, $file->id_files);

    include_once __DIR__.'/../addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, -$file->file_size);

}
