<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../lib/mysqli.php';

class BookmarkTags {

    static function add ($idusers, $idbookmarks, array $tagnames) {
        global $mysqli;
        foreach ($tagnames as $tagname) {
            mysqli_query(
                $mysqli,
                mysqli_sprintf(
                    $mysqli,
                    'insert into bookmarktags (idusers, idbookmarks, tagname)'
                    ." values (#u, #u, '#s')",
                    array($idusers, $idbookmarks, $tagname)
                )
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
            mysqli_sprintf(
                $mysqli,
                'delete from bookmarktags'
                .' where idbookmarks = #u',
                array($idbookmarks)
            )
        );
    }

    static function indexOnBookmark ($idbookmarks) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from bookmarktags where idbookmarks = #u'
                .' order by tagname',
                array($idbookmarks)
            )
        );
    }

    static function indexOnUser ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select distinct tagname from bookmarktags where idusers = #u'
                .' order by tagname',
                array($idusers)
            )
        );
    }

}
