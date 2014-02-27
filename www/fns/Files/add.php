<?php

namespace Files;

function add ($mysqli, $idusers, $idfolders, $filename, $filepath) {

    $filename = $mysqli->real_escape_string($filename);
    $filesize = filesize($filepath);
    $inserttime = time();

    $sql = 'insert into files'
        .' (idusers, idfolders, filename,'
        .' filesize, inserttime)'
        ." value ($idusers, $idfolders, '$filename',"
        ." $filesize, $inserttime)";

    $mysqli->query($sql);

    $id = $mysqli->insert_id;

    include_once __DIR__.'/filename.php';
    $filename = filename($idusers, $id);

    rename($filepath, $filename);

    include_once __DIR__.'/../Users/addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $idusers, $filesize);

}
