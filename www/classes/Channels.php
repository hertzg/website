<?php

include_once __DIR__.'/../fns/mysqli_query_object.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Channels {

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

    static function delete ($idusers, $id) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            'delete from channels'
            ." where idusers = $idusers and idchannels = $id"
        );
        include_once __DIR__.'/Notifications.php';
        Notifications::deleteOnChannel($idusers, $id);
    }

}
