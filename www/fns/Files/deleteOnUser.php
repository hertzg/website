<?php

namespace Files;

function deleteOnUser ($mysqli, $idusers) {

    $sql = "select * from files where idusers = $idusers";

    include_once __DIR__.'/../mysqli_query_object.php';
    $files = mysqli_query_object($mysqli, $sql);

    if ($files) {
        include_once __DIR__.'/filename.php';
        foreach ($files as $file) {
            $filename = filename($idusers, $file->idfiles);
            unlink($filename);
        }
    }

    mysqli_query($mysqli, "delete from files where idusers = $idusers");

}
