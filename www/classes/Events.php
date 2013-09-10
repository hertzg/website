<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../lib/mysqli.php';

class Events {

    static function add ($idusers, $eventtext, $eventtime) {
        global $mysqli;
        $time = time();
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'insert into events'
                .' (idusers, eventtext, eventtime, inserttime)'
                ." values (#u, '#s', #u, #u)",
                array($idusers, $eventtext, $eventtime, $time)
            )
        );
    }

    static function countOnTime ($idusers, $eventtime) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select count(*) count from events'
                .' where idusers = #u and eventtime = #u',
                array($idusers, $eventtime)
            )
        )->count;
    }

    static function delete ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from events'
                .' where idusers = #u and idevents = #u',
                array($idusers, $id)
            )
        );
    }

    static function edit ($idusers, $id, $eventtext) {
        global $mysqli;
        return mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update events set'
                ." eventtext = '#s',"
                .' edittime = #u'
                .' where idusers = #u and idevents = #u',
                array($eventtext, time(), $idusers, $id)
            )
        );
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from events where idusers = #u and idevents = #u',
                array($idusers, $id)
            )
        );
    }

    static function index ($idusers, $eventtime) {
        global $mysqli;
        return mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from events'
                .' where idusers = #u and eventtime = #u',
                array($idusers, $eventtime)
            )
        );
    }

}
