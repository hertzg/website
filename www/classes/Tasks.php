<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../lib/mysqli.php';
include_once 'TaskTags.php';

class Tasks {

    static function add ($idusers, $tasktext, $tags) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'insert into tasks'
                .' (idusers, tasktext, tags, inserttime, updatetime)'
                ." values (#u, '#s', '#s', #u, #u)",
                array($idusers, $tasktext, $tags, time(), time())
            )
        );
        $id = mysqli_insert_id($mysqli);
        TaskTags::add($idusers, $id, $tags);
    }

    static function count ($idusers) {
        global $mysqli;
        return mysqli_single_object($mysqli, "select count(*) count from tasks where idusers = $idusers")->count;
    }

    static function delete ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from tasks'
                .' where idusers = #u and idtasks = #u',
                array($idusers, $id)
            )
        );
        TaskTags::delete($id);
    }

    static function deleteUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from tasks where idusers = $idusers");
    }

    static function edit ($idusers, $id, $tasktext, $tags) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update tasks set'
                ." tasktext = '#s',"
                ." tags = '#s',"
                .' updatetime = #u'
                .' where idusers = #u and idtasks = #u',
                array($tasktext, $tags, time(), $idusers, $id)
            )
        );
        TaskTags::delete($id);
        TaskTags::add($idusers, $id, $tags);
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from tasks'
                .' where idusers = #u and idtasks = #u',
                array($idusers, $id)
            )
        );
    }

    static function index ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from tasks where idusers = #u'
                .' order by done, updatetime desc',
                array($idusers)
            )
        );
    }

    static function indexOnTag ($idusers, $tag) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from tasks t'
                .' where idusers = #u'
                .' and exists ('
                .'  select idtasks from tasktags tt'
                .'  where tt.idtasks = t.idtasks'
                ."  and tt.tagname = '#s'"
                .' )'
                .' order by done, updatetime desc',
                array($idusers, $tag)
            )
        );
    }

    static function setDone ($idusers, $id, $done) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update tasks set done = #b'
                .' where idusers = #u and idtasks = #u',
                array($done, $idusers, $id)
            )
        );
    }

}
