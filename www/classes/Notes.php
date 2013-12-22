<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Notes {

    static function add ($idusers, $notetext) {
        global $mysqli;
        $notetext = mysqli_real_escape_string($mysqli, $notetext);
        $inserttime = $updatetime = time();
        mysqli_query(
            $mysqli,
            'insert into notes'
            .' (idusers, notetext, inserttime, updatetime)'
            ." values ($idusers, '$notetext', $inserttime, $updatetime)"
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
        $notetext = mysqli_real_escape_string($mysqli, $notetext);
        $updatetime = time();
        mysqli_query(
            $mysqli,
            'update notes set'
            ." notetext = '$notetext',"
            .' updatetime = $updatetime'
            ." where idusers = $idusers and idnotes = $idnotes"
        );
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            'select * from notes'
            ." where idusers = $idusers and idnotes = $idnotes"
        );
    }

    static function index ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            "select * from notes where idusers = $idusers"
            .' order by updatetime desc'
        );
    }

    static function search ($idusers, $keyword) {
        global $mysqli;
        $keyword = str_replace(
            array('\\', '%', '_'),
            array('\\\\', '\\%', '\\_'),
            $keyword
        );
        $keyword = mysqli_real_escape_string($mysqli, $keyword);
        return mysqli_query_object(
            $mysqli,
            'select * from notes'
            ." where idusers = $idusers and notetext like '%$keyword%'"
            .' order by updatetime desc'
        );
    }

}
