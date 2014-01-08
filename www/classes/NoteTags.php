<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class NoteTags {

    static function add ($idusers, $idnotes, array $tagnames) {
        global $mysqli;
        foreach ($tagnames as $tagname) {
            $tagname = mysqli_real_escape_string($mysqli, $tagname);
            mysqli_query(
                $mysqli,
                'insert into notetags (idusers, idnotes, tagname)'
                ." values ($idusers, $idnotes, '$tagname')"
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

    static function indexOnUser ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select distinct tagname from notetags'
            ." where idusers = $idusers order by tagname"
        );
    }

}
