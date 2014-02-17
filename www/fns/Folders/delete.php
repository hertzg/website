<?php

namespace Folders;

function delete ($mysqli, $idusers, $idfolders) {

    include_once __DIR__.'/../Files/delete.php';
    include_once __DIR__.'/../Files/index.php';

    $idfolderss = array($idfolders);
    while ($idfolderss) {

        $idfolders = array_shift($idfolderss);
        mysqli_query(
            $mysqli,
            "delete from folders where idfolders = $idfolders"
        );

        include_once __DIR__.'/index.php';
        foreach (index($mysqli, $idusers, $idfolders) as $folder) {
            $idfolderss[] = $folder->idfolders;
        }

        foreach (\Files\index($mysqli, $idusers, $idfolders) as $file) {
            if (!in_array($file->idfolders, $idfolderss)) {
                $idfolderss[] = $idfolders;
            }
            \Files\delete($mysqli, $idusers, $file->idfiles);
        }

    }

}
