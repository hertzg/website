<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Notes {

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select count(*) count from notes where idusers = $idusers"
        )->count;
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

}
