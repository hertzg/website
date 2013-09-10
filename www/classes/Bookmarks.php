<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../lib/mysqli.php';

class Bookmarks {

    static function add ($idusers, $title, $url) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
            $mysqli,
                'insert into bookmarks'
                .' (idusers, title, url, inserttime, updatetime)'
                ." values (#u, '#s', '#s', #u, #u)",
                array($idusers, $title, $url, time(), time())
            )
        );
    }

    static function count ($idusers) {
        global $mysqli;
        return mysqli_single_object($mysqli, "select count(*) count from bookmarks where idusers = $idusers")->count;
    }

    static function delete ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from bookmarks'
                .' where idusers = #u and idbookmarks = #u',
                array($idusers, $id)
            )
        );
    }

    static function deleteUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from bookmarks where idusers = $idusers");
    }

    static function edit ($idusers, $id, $title, $url) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update bookmarks set'
                ." title = '#s',"
                ." url = '#s',"
                .' updatetime = #u'
                .' where idusers = #u and idbookmarks = #u',
                array($title, $url, time(), $idusers, $id)
            )
        );
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from bookmarks'
                .' where idusers = #u and idbookmarks = #u',
                array($idusers, $id)
            )
        );
    }

    static function index ($idusers) {

        global $mysqli;

        $bookmarks = mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from bookmarks where idusers = #u',
                array($idusers)
            )
        );

        usort($bookmarks, function ($a, $b) {
            return $a->updatetime > $b->updatetime ? -1 : 1;
        });

        return $bookmarks;

    }

}
