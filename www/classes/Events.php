<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Events {

    static function countOnTime ($idusers, $eventtime) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            'select count(*) count from events'
            ." where idusers = $idusers and eventtime = $eventtime"
        )->count;
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
