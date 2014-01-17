<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Tasks {

    static function add ($idusers, $tasktext, $tags) {
        global $mysqli;
        $tasktext = mysqli_real_escape_string($mysqli, $tasktext);
        $tags = mysqli_real_escape_string($mysqli, $tags);
        $inserttime = $updatetime = time();
        mysqli_query(
            $mysqli,
            'insert into tasks'
            .' (idusers, tasktext, tags, inserttime, updatetime)'
            ." values ($idusers, '$tasktext', '$tags', $inserttime, $updatetime)"
        );
        return mysqli_insert_id($mysqli);
    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select count(*) count from tasks where idusers = $idusers"
        )->count;
    }

    static function delete ($id) {
        global $mysqli;
        mysqli_query($mysqli, "delete from tasks where idtasks = $id");
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from tasks where idusers = $idusers");
    }

    static function edit ($idusers, $id, $tasktext, $tags) {
        global $mysqli;
        $tasktext = mysqli_real_escape_string($mysqli, $tasktext);
        $tags = mysqli_real_escape_string($mysqli, $tags);
        $updatetime = time();
        mysqli_query(
            $mysqli,
            'update tasks set'
            ." tasktext = '$tasktext',"
            ." tags = '$tags',"
            ." updatetime = $updatetime"
            ." where idusers = $idusers and idtasks = $id"
        );
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            'select * from tasks'
            ." where idusers = $idusers and idtasks = $id"
        );
    }

    static function index ($idusers) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            "select * from tasks where idusers = $idusers"
            .' order by done, updatetime desc'
        );
    }

    static function search ($idusers, $keyword) {
        global $mysqli;
        include_once __DIR__.'/../fns/escape_like.php';
        $keyword = escape_like($keyword);
        $keyword = mysqli_real_escape_string($mysqli, $keyword);
        return mysqli_query_object(
            $mysqli,
            'select * from tasks'
            ." where idusers = $idusers and tasktext like '%$keyword%'"
            .' order by done, updatetime desc'
        );
    }

    static function setDone ($idusers, $id, $done) {
        global $mysqli;
        $done = $done ? '1' : '0';
        $updatetime = time();
        mysqli_query(
            $mysqli,
            'update tasks set'
            ." done = $done,"
            ." updatetime = $updatetime"
            ." where idusers = $idusers and idtasks = $id"
        );
    }

}
