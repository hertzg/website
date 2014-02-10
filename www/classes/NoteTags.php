<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class NoteTags {

    static function add ($idusers, $idnotes, array $tagnames, $notetext) {
        global $mysqli;
        $notetext = mysqli_real_escape_string($mysqli, $notetext);
        $inserttime = $updatetime = time();
        foreach ($tagnames as $tagname) {
            $tagname = mysqli_real_escape_string($mysqli, $tagname);
            mysqli_query(
                $mysqli,
                'insert into notetags (idusers, idnotes, tagname,'
                .' notetext, inserttime, updatetime)'
                ." values ($idusers, $idnotes, '$tagname',"
                ." '$notetext', $inserttime, $updatetime)"
            );
        }
    }

    static function deleteOnNote ($idnotes) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "delete from notetags where idnotes = $idnotes"
        );
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from notetags where idusers = $idusers");
    }

    static function indexOnNote ($idnotes) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select * from notetags'
            ." where idnotes = $idnotes order by tagname"
        );
    }

    static function indexOnTagName ($idusers, $tagname) {
        global $mysqli;
        $tagname = mysqli_real_escape_string($mysqli, $tagname);
        return mysqli_query_object(
            $mysqli,
            'select * from notetags'
            ." where idusers = $idusers"
            ." and tagname = '$tagname'"
            .' order by updatetime desc'
        );
    }

    static function indexOnUser ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select distinct tagname from notetags'
            ." where idusers = $idusers order by tagname"
        );
    }

}
