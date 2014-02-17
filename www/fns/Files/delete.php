<?php

namespace Files;

function delete ($mysqli, $idusers, $id) {

    mysqli_query(
        $mysqli,
        "delete from files where idusers = $idusers and idfiles = $id"
    );

    include_once __DIR__.'/filename.php';
    $filename = filename($idusers, $id);

    if (is_file($filename)) {

        $filesize = filesize($filename);
        unlink($filename);

        mysqli_query(
            $mysqli,
            "update users set storageused = storageused - $filesize"
            ." where idusers = $idusers"
        );

    }
}
