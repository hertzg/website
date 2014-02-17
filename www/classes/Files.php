<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Files {

    static function add ($idusers, $idfolders, $filename, $filepath) {

        global $mysqli;

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

}
