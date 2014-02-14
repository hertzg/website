<?php

include_once __DIR__.'/../fns/hex2bin.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Users {

    static function addNumNotifications ($idusers, $numnotifications) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            'update users set'
            ." numnotifications = numnotifications + $numnotifications"
            ." where idusers = $idusers"
        );
    }

}
