<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Files {

    static function add ($idusers, $idfolders, $filename, $filepath) {

        global $mysqli;

        $foldername = mysqli_real_escape_string($mysqli, $foldername);
        $filesize = filesize($filepath);
        $inserttime = time();
        mysqli_query(
            $mysqli,
            'insert into files'
            .' (idusers, idfolders, filename, filesize, inserttime)'
            ." value ($idusers, $idfolders, $foldername', $filesize, $inserttime)"
        );

        $id = mysqli_insert_id($mysqli);
        rename($filepath, self::filename($idusers, $id));

        mysqli_query(
            $mysqli,
            "update users set storageused = storageused + $filesize"
            ." where idusers = $idusers"
        );

    }

    static function delete ($idusers, $id) {

        global $mysqli;

        mysqli_query(
            $mysqli,
            "delete from files where idusers = $idusers and idfiles = $id"
        );

        $filename = self::filename($idusers, $id);
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

    static function deleteOnUser ($idusers) {
        global $mysqli;
        $files = mysqli_query_object(
            $mysqli,
            "select * from files where idusers = $idusers"
        );
        foreach ($files as $file) {
            unlink(self::filename($idusers, $file->idfiles));
        }
        mysqli_query($mysqli, "delete from files where idusers = $idusers");
    }

    static function filename ($idusers, $id) {
        return __DIR__."/../users/$idusers/$id";
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            'select * from files'
            ." where idusers = $idusers and idfiles = $id"
        );
   }

    static function getByName ($idusers, $idfolders, $filename, $excludeid = 0) {
        global $mysqli;
        $filename = mysqli_real_escape_string($mysqli, $filename);
        return mysqli_single_object(
            $mysqli,
            'select * from files'
            ." where idusers = $idusers and idfolders = $idfolders"
            ." and filename = '$filename' and idfiles != $excludeid"
        );
    }

    static function index ($idusers, $idfolders, $offset = 0) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select * from files'
            ." where idusers = $idusers and idfolders = $idfolders"
            .' order by filename'
        );
    }

    static function rename ($idusers, $id, $filename) {
        global $mysqli;
        $filename = mysqli_real_escape_string($mysqli, $filename);
        mysqli_query(
            $mysqli,
            "update files set filename = '$filename'"
            ." where idusers = $idusers and idfiles = $id"
        );
    }

    static function move ($idusers, $id, $idfolders) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "update files set idfolders = $idfolders"
            ." where idusers = $idusers and idfiles = $id"
        );
    }

}
