<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Notes {

    static function add ($idusers, $notetext, $tags) {
        global $mysqli;
        $notetext = mysqli_real_escape_string($mysqli, $notetext);
        $tags = mysqli_real_escape_string($mysqli, $tags);
        $inserttime = $updatetime = time();
        mysqli_query(
            $mysqli,
            'insert into notes'
            .' (idusers, notetext, tags,'
            .' inserttime, updatetime)'
            ." values ($idusers, '$notetext', '$tags',"
            ." $inserttime, $updatetime)"
        );
        return mysqli_insert_id($mysqli);
    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select count(*) count from notes where idusers = $idusers"
        )->count;
    }

    static function delete ($id) {
        global $mysqli;
        mysqli_query($mysqli, "delete from notes where idnotes = $id");
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from notes where idusers = $idusers");
    }

    static function edit ($idusers, $id, $notetext, $tags) {
        global $mysqli;
        $notetext = mysqli_real_escape_string($mysqli, $notetext);
        $tags = mysqli_real_escape_string($mysqli, $tags);
        $updatetime = time();
        mysqli_query(
            $mysqli,
            'update notes set'
            ." notetext = '$notetext',"
            ." tags = '$tags',"
            ." updatetime = $updatetime"
            ." where idusers = $idusers and idnotes = $id"
        );
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            'select * from notes'
            ." where idusers = $idusers and idnotes = $id"
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
        include_once __DIR__.'/../fns/escape_like.php';
        $keyword = escape_like($keyword);
        $keyword = mysqli_real_escape_string($mysqli, $keyword);
        return mysqli_query_object(
            $mysqli,
            'select * from notes'
            ." where idusers = $idusers and notetext like '%$keyword%'"
            .' order by updatetime desc'
        );
    }

}
