<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../classes/Files.php';
include_once __DIR__.'/../lib/mysqli.php';

class Folders {

    static function add ($idusers, $parentidfolders, $foldername) {

        global $mysqli;

        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'insert into folders'
                .' (idusers, parentidfolders, foldername, inserttime)'
                ." values (#u, #u, '#s', #u)",
                array($idusers, $parentidfolders, $foldername, time())
            )
        );

        return mysqli_insert_id($mysqli);

    }

    static function delete ($idusers, $idfolders) {
        global $mysqli;
        $idfolderss = array($idfolders);
        while ($idfolderss) {
            $idfolders = array_shift($idfolderss);
            mysqli_query(
                $mysqli,
                mysqli_sprintf(
                    $mysqli,
                    'delete from folders where idfolders = #u',
                    array($idfolders)
                )
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

    static function deleteUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from folders where idusers = $idusers");
    }

    static function get ($idusers, $idfolders) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from folders'
                .' where idusers = #u and idfolders = #u',
                array($idusers, $idfolders)
            )
        );
    }

    static function getByName ($idusers, $parentidfolders, $foldername, $excludeidfolders = 0) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from folders'
                .' where idusers = #u and parentidfolders = #u'
                ." and foldername = '#s' and idfolders != #u",
                array($idusers, $parentidfolders, $foldername, $excludeidfolders)
            )
        );
    }

    static function index ($idusers, $parentidfolders) {

        global $mysqli;

        $folders = mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from folders'
                .' where idusers = #u and parentidfolders = #u',
                array($idusers, $parentidfolders)
            )
        );

        usort($folders, function ($a, $b) {
            return $a->foldername > $b->foldername ? 1 : -1;
        });

        return $folders;

    }

    static function move ($idusers, $idfolders, $parentidfolders) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update folders set parentidfolders = #u'
                .' where idusers = #u and idfolders = #u',
                array($parentidfolders, $idusers, $idfolders)
            )
        );
    }

    static function rename ($idusers, $idfolders, $foldername) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                "update folders set foldername = '#s'"
                .' where idusers = #u and idfolders = #u',
                array($foldername, $idusers, $idfolders)
            )
        );
    }

}
