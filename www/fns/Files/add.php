<?php

namespace Files;

function add ($mysqli, $idusers, $idfolders, $filename, $filepath) {

    $filename = mysqli_real_escape_string($mysqli, $filename);
    $filesize = filesize($filepath);
    $inserttime = time();
    mysqli_query(
        $mysqli,
        'insert into files'
        .' (idusers, idfolders, filename,'
        .' filesize, inserttime)'
        ." value ($idusers, $idfolders, '$filename',"
        ." $filesize, $inserttime)"
    );

    $id = mysqli_insert_id($mysqli);

    include_once __DIR__.'/filename.php';
    $filename = filename($idusers, $id);

    rename($filepath, $filename);

    include_once __DIR__.'/../Users/addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $idusers, $filesize);

}
