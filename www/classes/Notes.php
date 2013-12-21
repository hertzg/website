<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../lib/mysqli.php';

class Notes {

    static function add ($idusers, $notetext) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'insert into notes'
                .' (idusers, notetext, inserttime, updatetime)'
                ." values (#u, '#s', #u, #u)",
                array($idusers, $notetext, time(), time())
            )
        );
    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select count(*) count from notes where idusers = $idusers"
        )->count;
    }

    static function delete ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "delete from notes where idusers = $idusers and idnotes = $id"
        );
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from notes where idusers = $idusers");
    }

    static function edit ($idusers, $id, $notetext) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update notes set'
                ." notetext = '#s',"
                .' updatetime = #u'
                .' where idusers = #u and idnotes = #u',
                array($notetext, time(), $idusers, $id)
            )
        );
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from notes'
                .' where idusers = #u and idnotes = #u',
                array($idusers, $id)
            )
        );
    }

    static function index ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from notes where idusers = #u'
                .' order by updatetime desc',
                array($idusers)
            )
        );
    }

    static function search ($idusers, $keyword) {
        global $mysqli;
        $keyword = str_replace(
            array('\\', '%', '_'),
            array('\\\\', '\\%', '\\_'),
            $keyword
        );
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from notes'
                ." where idusers = #u and notetext like '%#s%'"
                .' order by updatetime desc',
                array($idusers, $keyword)
            )
        );
    }

}
