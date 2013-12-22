<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Channels {

    static function add ($idusers, $channelname) {
        global $mysqli;
        include_once __DIR__.'/../fns/uniqmd5.php';
        $channelname = mysqli_real_escape_string($mysqli, $channelname);
        $channelkey = mysqli_real_escape_string($mysqli, uniqmd5(true));
        mysqli_query(
            $mysqli,
            'insert into channels (idusers, channelname, channelkey)'
            ." values ($idusers, '$channelname', '$channelkey')"
        );
        return mysqli_insert_id($mysqli);
    }

    static function addNumNotifications ($idusers, $id, $numnotifications) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            'update channels set'
            ." numnotifications = numnotifications + $numnotifications"
            ." where idchannels = $id"
        );
    }

    static function clearNumNotifications ($idusers) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            'update channels set numnotifications = 0'
            ." where idusers = $idusers"
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
            "delete from channels where idusers = $idusers and idchannels = $id"
        );
        include_once __DIR__.'/Notifications.php';
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
            'select * from channels'
            ." where idusers = $idusers and idchannels = $id"
        );
    }

    static function getByName ($idusers, $channelname) {
        global $mysqli;
        $channelname = mysqli_real_escape_string($mysqli, $channelname);
        return mysqli_single_object(
            $mysqli,
            'select * from channels'
            ." where idusers = $idusers and channelname = '$channelname'"
        );
    }

    static function getByNameKey ($channelname, $channelkey) {
        global $mysqli;
        $channelname = mysqli_real_escape_string($mysqli, $channelname);
        $channelkey = mysqli_real_escape_string($mysqli, $channelkey);
        return mysqli_single_object(
            $mysqli,
            'select * from channels'
            ." where channelname = '$channelname' and channelkey = '$channelkey'"
        );
    }

    static function index ($idusers) {

        global $mysqli;

        $channels = mysqli_query_object(
            $mysqli,
            "select * from channels where idusers = $idusers"
        );

        usort($channels, function ($a, $b) {
            return strcasecmp($a->channelname, $b->channelname);
        });

        return $channels;

    }

    static function randomizeKey ($idusers, $id) {
        global $mysqli;
        include_once __DIR__.'/../fns/uniqmd5.php';
        $channelkey = mysqli_real_escape_string($mysqli, uniqmd5(true));
        mysqli_query(
            $mysqli,
            "update channels set channelkey = '$channelkey'"
            ." where idusers = $idusers and idchannels = $id"
        );
    }

}
