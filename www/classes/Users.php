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

    static function clearNumNotifications ($idusers) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            'update users set numnotifications = 0'
            ." where idusers = $idusers"
        );
    }

    static function editResetPasswordKey ($idusers, $resetpasswordkey) {
        global $mysqli;
        $resetpasswordkey = mysqli_real_escape_string($mysqli, $resetpasswordkey);
        mysqli_query(
            $mysqli,
            "update users set resetpasswordkey = '$resetpasswordkey'"
            ." where idusers = $idusers"
        );
    }

}
