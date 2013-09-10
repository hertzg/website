<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../lib/mysqli.php';

class Files {

    static function add ($idusers, $idfolders, $filename, $filepath) {

        global $mysqli;

        $filesize = filesize($filepath);
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'insert into files'
                .' (idusers, idfolders, filename, filesize, inserttime)'
                ." value (#u, #u, '#s', #u, #u)",
                array($idusers, $idfolders, $filename, $filesize, time())
            )
        );

        $id = mysqli_insert_id($mysqli);
        rename($filepath, self::filename($idusers, $id));

        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update users set storageused = storageused + #u'
                .' where idusers = #u',
                array($filesize, $idusers)
            )
        );

    }

    static function delete ($idusers, $id) {

        global $mysqli;

        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from files where idfiles = #u',
                array($id)
            )
        );

        $filename = self::filename($idusers, $id);
        if (is_file($filename)) {

            $filesize = filesize($filename);
            unlink($filename);

            mysqli_query(
                $mysqli,
                mysqli_sprintf(
                    $mysqli,
                    'update users set storageused = storageused - #u'
                    .' where idusers = #u',
                    array($filesize, $idusers)
                )
            );

        }
    }

    static function deleteUser ($idusers) {
        global $mysqli;
        $files = mysqli_query_object($mysqli, "select * from files where idusers = $idusers");
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
            mysqli_sprintf(
                $mysqli,
                'select * from files'
                .' where idusers = #u and idfiles = #u',
                array($idusers, $id)
            )
        );
   }

    static function getByName ($idusers, $idfolders, $filename, $excludeid = 0) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from files'
                .' where idusers = #u and idfolders = #u'
                ." and filename = '#s' and idfiles != #u",
                array($idusers, $idfolders, $filename, $excludeid)
            )
        );
    }

    static function index ($idusers, $idfolders, $offset = 0) {

        global $mysqli;

        $files = mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from files'
                .' where idusers = #u and idfolders = #u',
                array($idusers, $idfolders)
            )
        );

        usort($files, function ($a, $b) {
            return $a->filename > $b->filename ? 1 : -1;
        });

        return $files;

    }

    static function rename ($idusers, $id, $filename) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                "update files set filename = '#s'"
                .' where idusers = #u and idfiles = #u',
                array($filename, $idusers, $id)
            )
        );
    }

    static function move ($idusers, $id, $idfolders) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update files set idfolders = #u'
                .' where idusers = #u and idfiles = #u',
                array($idfolders, $idusers, $id)
            )
        );
    }

    static function replaceWithString ($idusers, $id, $contents) {
        global $mysqli;
        $filesize = strlen($contents);
        $file = self::get($idusers, $id);
        if ($file) {
            mysqli_query(
                $mysqli,
                mysqli_sprintf(
                    $mysqli,
                    'update users set storageused = storageused + #u'
                    .' where idusers - #u',
                    array($filesize - $file->filesize, $idusers)
                )
            );
            mysqli_query(
                $mysqli,
                mysqli_sprintf(
                    $mysqli,
                    'update files set filesize = #u'
                    .' where idusers = #u and idfiles = #u',
                    array($filesize, $idusers, $id)
                )
            );
            file_put_contents(self::filename($idusers, $id), $contents);
        }
    }

}
