<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class ContactTags {

    static function add ($idusers, $idcontacts, array $tagnames) {
        global $mysqli;
        foreach ($tagnames as $tagname) {
            $tagname = mysqli_real_escape_string($mysqli, $tagname);
            mysqli_query(
                $mysqli,
                'insert into contacttags (idusers, idcontacts, tagname)'
                ." values ($idusers, $idcontacts, '$tagname')"
            );
        }
    }

    static function deleteOnContact ($idcontacts) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "delete from contacttags where idcontacts = $idcontacts"
        );
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "delete from contacttags where idusers = $idusers"
        );
    }

    static function indexOnContact ($idcontacts) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select * from contacttags'
            ." where idcontacts = $idcontacts order by tagname"
        );
    }

    static function indexOnUser ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select distinct tagname from contacttags'
            ." where idusers = $idusers order by tagname"
        );
    }

}
