<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Folders {

    static function add ($idusers, $parentidfolders, $foldername) {
        global $mysqli;
        $foldername = mysqli_real_escape_string($mysqli, $foldername);
        $inserttime = time();
        mysqli_query(
            $mysqli,
            'insert into folders'
            .' (idusers, parentidfolders, foldername, inserttime)'
            ." values ($idusers, $parentidfolders, '$foldername', $inserttime)"
        );
        return mysqli_insert_id($mysqli);
    }

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
            foreach (Folders::index($idusers, $idfolders) as $folder) {
                $idfolderss[] = $folder->idfolders;
            }
            foreach (Files::index($idusers, $idfolders) as $file) {
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

    static function get ($idusers, $idfolders) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            'select * from folders'
            ." where idusers = $idusers and idfolders = $idfolders"
        );
    }

    static function getByName ($idusers, $parentidfolders, $foldername, $excludeidfolders = 0) {
        global $mysqli;
        $foldername = mysqli_real_escape_string($mysqli, $foldername);
        return mysqli_single_object(
            $mysqli,
            'select * from folders'
            ." where idusers = $idusers"
            ." and parentidfolders = $parentidfolders"
            ." and foldername = '$foldername'"
            ." and idfolders != $excludeidfolders"
        );
    }

    static function index ($idusers, $parentidfolders) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select * from folders'
            ." where idusers = $idusers and parentidfolders = $parentidfolders"
            .' order by foldername'
        );
    }

    static function move ($idusers, $idfolders, $parentidfolders) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "update folders set parentidfolders = $parentidfolders"
            ." where idusers = $idusers and idfolders = $idfolders"
        );
    }

    static function rename ($idusers, $idfolders, $foldername) {
        global $mysqli;
        $foldername = mysqli_real_escape_string($mysqli, $foldername);
        mysqli_query(
            $mysqli,
            "update folders set foldername = '$foldername'"
            ." where idusers = $idusers and idfolders = $idfolders"
        );
    }

}
