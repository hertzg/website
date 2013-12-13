<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../fns/str_collapse_spaces.php';
include_once __DIR__.'/../lib/mysqli.php';

class TaskTags {

    const MAX_NUM_TAGS = 5;

    static function add ($idusers, $id, array $tagnames) {
        global $mysqli;
        foreach ($tagnames as $tagname) {
            mysqli_query(
                $mysqli,
                mysqli_sprintf(
                    $mysqli,
                    'insert into tasktags (idusers, idtasks, tagname)'
                    ." values (#u, #u, '#s')",
                    array($idusers, $id, $tagname)
                )
            );
        }
    }

    static function parse ($tagnames) {
        $tagnames = str_collapse_spaces($tagnames);
        if ($tagnames === '') return array();
        $tagnames = explode(' ', $tagnames);
        $tagnames = array_unique($tagnames);
        return $tagnames;
    }

    static function delete ($id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from tasktags'
                .' where idtasks = #u',
                array($id)
            )
        );
    }

    static function deleteUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from tasktags where idusers = $idusers");
    }

    static function indexOnUser ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from tasktags where idusers = #u'
                .' order by tagname',
                array($idusers)
            )
        );
    }

    static function index ($id) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from tasktags where idtasks = #u'
                .' order by tagname',
                array($id)
            )
        );
    }

}
