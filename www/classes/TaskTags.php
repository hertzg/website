<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class TaskTags {

    static function add ($idusers, $idtasks, array $tagnames, $tasktext, $tags) {
        global $mysqli;
        $tasktext = mysqli_real_escape_string($mysqli, $tasktext);
        $tags = mysqli_real_escape_string($mysqli, $tags);
        $inserttime = $updatetime = time();
        foreach ($tagnames as $tagname) {
            $tagname = mysqli_real_escape_string($mysqli, $tagname);
            mysqli_query(
                $mysqli,
                'insert into tasktags (idusers, idtasks, tagname,'
                .' tasktext, tags, inserttime, updatetime)'
                ." values ($idusers, $idtasks, '$tagname',"
                ." '$tasktext', '$tags', $inserttime, $updatetime)"
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

    static function indexOnTagName ($idusers, $tagname) {
        global $mysqli;
        $tagname = mysqli_real_escape_string($mysqli, $tagname);
        return mysqli_query_object(
            $mysqli,
            'select * from tasktags'
            ." where idusers = $idusers"
            ." and tagname = '$tagname'"
            .' order by done, updatetime desc'
        );
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

    static function setTaskDone ($idtasks, $done) {
        global $mysqli;
        $done = $done ? '1' : '0';
        mysqli_query(
            $mysqli,
           "update tasktags set done = $done where idtasks = $idtasks"
        );
    }

}
