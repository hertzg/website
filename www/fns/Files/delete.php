<?php

namespace Files;

function delete ($mysqli, $idusers, $id) {

    $sql = "delete from files where idusers = $idusers and idfiles = $id";
    $mysqli->query($sql);

    include_once __DIR__.'/filename.php';
    $filename = filename($idusers, $id);

    if (is_file($filename)) {

        $filesize = filesize($filename);
        unlink($filename);

        include_once __DIR__.'/../Users/addStorageUsed.php';
        \Users\addStorageUsed($mysqli, $idusers, -$filesize);

    }
}
