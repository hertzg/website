<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../lib/mysqli.php';

class TaskTags {

    const MAX_NUM_TAGS = 5;

    static function add ($idusers, $idtasks, array $tagnames) {
        global $mysqli;
        foreach ($tagnames as $tagname) {
            mysqli_query(
                $mysqli,
                mysqli_sprintf(
                    $mysqli,
                    'insert into tasktags (idusers, idtasks, tagname)'
                    ." values (#u, #u, '#s')",
                    array($idusers, $idtasks, $tagname)
                )
            );
        }
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from tasktags where idusers = $idusers");
    }

    static function deleteOnTask ($idtasks) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from tasktags'
                .' where idtasks = #u',
                array($idtasks)
            )
        );
    }

    static function indexOnTask ($idtasks) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from tasktags where idtasks = #u'
                .' order by tagname',
                array($idtasks)
            )
        );
    }

    static function indexOnUser ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select distinct tagname from tasktags where idusers = #u'
                .' order by tagname',
                array($idusers)
            )
        );
    }

}
