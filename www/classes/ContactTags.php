<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class ContactTags {

    static function add ($idusers, $idcontacts, array $tagnames, $fullname) {
        global $mysqli;
        $fullname = mysqli_real_escape_string($mysqli, $fullname);
        foreach ($tagnames as $tagname) {
            $tagname = mysqli_real_escape_string($mysqli, $tagname);
            mysqli_query(
                $mysqli,
                'insert into contacttags (idusers, idcontacts, tagname, fullname)'
                ." values ($idusers, $idcontacts, '$tagname', '$fullname')"
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

    static function indexOnTagName ($idusers, $tagname) {
        global $mysqli;
        $tagname = mysqli_real_escape_string($mysqli, $tagname);
        return mysqli_query_object(
            $mysqli,
            'select * from contacttags'
            ." where idusers = $idusers"
            ." and tagname = '$tagname'"
            .' order by fullname'
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

    static function searchOnTagName ($idusers, $keyword, $tagname) {
        global $mysqli;
        include_once __DIR__.'/../fns/escape_like.php';
        $keyword = escape_like($keyword);
        $keyword = mysqli_real_escape_string($mysqli, $keyword);
        $tagname = mysqli_real_escape_string($mysqli, $tagname);
        return mysqli_query_object(
            $mysqli,
            'select * from contacttags'
            ." where idusers = $idusers"
            ." and fullname like '%$keyword%'"
            ." and tagname = '$tagname'"
            .' order by fullname'
        );
    }

}
