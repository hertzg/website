<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Events {

    static function add ($idusers, $eventtext, $eventtime) {
        global $mysqli;
        $eventtext = mysqli_real_escape_string($mysqli, $eventtext);
        $inserttime = time();
        mysqli_query(
            $mysqli,
            'insert into events'
            .' (idusers, eventtext, eventtime, inserttime)'
            ." values ($idusers, '$eventtext', $eventtime, $inserttime)"
        );
        return mysqli_insert_id($mysqli);
    }

    static function countOnTime ($idusers, $eventtime) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            'select count(*) count from events'
            ." where idusers = $idusers and eventtime = $eventtime"
        )->count;
    }

    static function delete ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            "delete from events where idusers = $idusers and idevents = $id"
        );
    }

    static function edit ($idusers, $id, $eventtext) {
        global $mysqli;
        $eventtext = mysqli_real_escape_string($mysqli, $eventtext);
        $edittime = time();
        return mysqli_query(
            $mysqli,
            'update events set'
            ." eventtext = '$eventtext',"
            ." edittime = $edittime"
            ." where idusers = $idusers and idevents = $id"
        );
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            'select * from events'
            ." where idusers = $idusers and idevents = $id"
        );
    }

    static function index ($idusers, $eventtime) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            'select * from events'
            ." where idusers = $idusers and eventtime = $eventtime"
        );
    }

}
