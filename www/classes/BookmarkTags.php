<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class BookmarkTags {

    static function add ($idusers, $idbookmarks, array $tagnames) {
        global $mysqli;
        foreach ($tagnames as $tagname) {
            $tagname = mysqli_real_escape_string($mysqli, $tagname);
            mysqli_query(
                $mysqli,
                'insert into bookmarktags (idusers, idbookmarks, tagname)'
                ." values ($idusers, $idbookmarks, '$tagname')"
            );
        }
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from bookmarktags where idusers = $idusers");
    }

    static function deleteOnBookmark ($idbookmarks) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "delete from bookmarktags where idbookmarks = $idbookmarks"
        );
    }

    static function indexOnBookmark ($idbookmarks) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select * from bookmarktags'
            ." where idbookmarks = $idbookmarks order by tagname"
        );
    }

    static function indexOnUser ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select distinct tagname from bookmarktags'
            ." where idusers = $idusers order by tagname"
        );
    }

}
