<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../fns/uniqmd5.php';
include_once __DIR__.'/../lib/mysqli.php';
include_once __DIR__.'/../classes/Notifications.php';

class Channels {

    static function add ($idusers, $channelname) {

        global $mysqli;

        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'insert into channels (idusers, channelname, channelkey)'
                ." values (#u, '#s', '#s')",
                array($idusers, $channelname, uniqmd5(true))
            )
        );

        return mysqli_insert_id($mysqli);

    }

    static function addNumNotifications ($idusers, $id, $numnotifications) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update channels set numnotifications = numnotifications + #u'
                .' where idchannels = #u',
                array($numnotifications, $id)
            )
        );
    }

    static function clearNumNotifications ($idusers) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update channels set numnotifications = 0'
                .' where idusers = #u',
                array($idusers)
            )
        );
    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select count(*) count from channels where idusers = $idusers"
        )->count;
    }

    static function delete ($idusers, $id) {

        global $mysqli;

        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'delete from channels'
                .' where idusers = #u and idchannels = #u',
                array($idusers, $id)
            )
        );

        Notifications::deleteOnChannel($idusers, $id);

    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from channels where idusers = $idusers");
    }

    static function get ($idusers, $id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from channels'
                .' where idusers = #u and idchannels = #u',
                array($idusers, $id)
            )
        );
    }

    static function getByName ($idusers, $channelname) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from channels'
                ." where idusers = #u and channelname = '#s'",
                array($idusers, $channelname)
            )
        );
    }

    static function getByNameKey ($channelname, $channelkey) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from channels'
                ." where channelname = '#s' and channelkey = '#s'",
                array($channelname, $channelkey)
            )
        );
    }

    static function index ($idusers) {

        global $mysqli;

        $channels = mysqli_query_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from channels where idusers = #u',
                array($idusers)
            )
        );

        usort($channels, function ($a, $b) {
            return strcasecmp($a->channelname, $b->channelname);
        });

        return $channels;

    }

    static function randomizeKey ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                "update channels set channelkey = '#s'"
                .' where idusers = #u and idchannels = #u',
                array(uniqmd5(true), $idusers, $id)
            )
        );
    }

}
