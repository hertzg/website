<?php

namespace Folders;

function delete ($mysqli, $idusers, $idfolders) {

    include_once __DIR__.'/../Files/delete.php';
    include_once __DIR__.'/../Files/indexInUserFolder.php';

    $idfolderss = [$idfolders];
    while ($idfolderss) {

        $idfolders = array_shift($idfolderss);
        $mysqli->query("delete from folders where idfolders = $idfolders");

        include_once __DIR__.'/indexInUserFolder.php';
        foreach (indexInUserFolder($mysqli, $idusers, $idfolders) as $folder) {
            $idfolderss[] = $folder->idfolders;
        }

        foreach (\Files\indexInUserFolder($mysqli, $idusers, $idfolders) as $file) {
            if (!in_array($file->idfolders, $idfolderss)) {
                $idfolderss[] = $idfolders;
            }
            \Files\delete($mysqli, $idusers, $file->idfiles);
        }

    }

}
