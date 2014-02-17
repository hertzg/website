<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Folders {

    static function delete ($idusers, $idfolders) {
        include_once 'Files.php';
        global $mysqli;
        $idfolderss = array($idfolders);
        while ($idfolderss) {

            $idfolders = array_shift($idfolderss);
            mysqli_query(
                $mysqli,
                "delete from folders where idfolders = $idfolders"
            );

            include_once __DIR__.'/../fns/Folders/index.php';
            foreach (Folders\index($mysqli, $idusers, $idfolders) as $folder) {
                $idfolderss[] = $folder->idfolders;
            }

            include_once __DIR__.'/../fns/Files/index.php';
            foreach (Files\index($mysqli, $idusers, $idfolders) as $file) {
                if (!in_array($file->idfolders, $idfolderss)) {
                    $idfolderss[] = $idfolders;
                }
                Files::delete($idusers, $file->idfiles);
            }

        }
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from folders where idusers = $idusers");
    }

}
