<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class TaskTags {

    static function add ($idusers, $idtasks, array $tagnames) {
        global $mysqli;
        foreach ($tagnames as $tagname) {
            $tagname = mysqli_real_escape_string($mysqli, $tagname);
            mysqli_query(
                $mysqli,
                'insert into tasktags (idusers, idtasks, tagname)'
                ." values ($idusers, $idtasks, '$tagname')"
            );
        }
    }

    static function deleteOnTask ($idtasks) {
        global $mysqli;
        mysqli_query($mysqli, "delete from tasktags where idtasks = $idtasks");
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from tasktags where idusers = $idusers");
    }

    static function indexOnTask ($idtasks) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select * from tasktags'
            ." where idtasks = $idtasks order by tagname"
        );
    }

    static function indexOnUser ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select distinct tagname from tasktags'
            ." where idusers = $idusers order by tagname"
        );
    }

}
