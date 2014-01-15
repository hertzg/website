<?php

include_once __DIR__.'/../fns/hex2bin.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Users {

    static function add ($username, $email, $password) {
        global $mysqli;
        $username = mysqli_real_escape_string($mysqli, $username);
        $email = mysqli_real_escape_string($mysqli, $email);
        $password = mysqli_real_escape_string($mysqli, md5($password, true));
        $inserttime = time();
        mysqli_query(
            $mysqli,
            'insert into users (username, email, password, inserttime)'
            ." values ('$username', '$email', '$password', $inserttime)"
        );
        $idusers = mysqli_insert_id($mysqli);
        mkdir(__DIR__."/../users/$idusers");
    }

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

    static function delete ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from users where idusers = $idusers");
        rmdir(__DIR__."/../users/$idusers");
    }

    static function editPassword ($idusers, $password) {
        global $mysqli;
        $password = mysqli_real_escape_string($mysqli, md5($password, true));
        mysqli_query(
            $mysqli,
            'update users set'
            ." password = '$password',"
            .' resetpasswordkey = null'
            ." where idusers = $idusers"
        );
    }

    static function editProfile ($idusers, $email, $fullname) {
        global $mysqli;
        $email = mysqli_real_escape_string($mysqli, $email);
        $fullname = mysqli_real_escape_string($mysqli, $fullname);
        mysqli_query(
            $mysqli,
            'update users set'
            ." email = '$email',"
            ." fullname = '$fullname'"
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

    static function editTheme ($idusers, $theme) {
        global $mysqli;
        $theme = mysqli_real_escape_string($mysqli, $theme);
        mysqli_query(
            $mysqli,
            "update users set theme = '$theme' where idusers = $idusers"
        );
    }

    static function get ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select * from users where idusers = $idusers"
        );
    }

    static function getByEmail ($email, $excludeidusers = 0) {
        global $mysqli;
        $email = mysqli_real_escape_string($mysqli, $email);
        return mysqli_single_object(
            $mysqli,
            'select * from users'
            ." where email = '$email' and idusers != $excludeidusers"
        );
    }

    static function getByResetPasswordKey ($idusers, $resetpasswordkey) {
        global $mysqli;
        include_once __DIR__.'/../fns/hex2bin.php';
        $resetpasswordkey = mysqli_real_escape_string($mysqli, hex2bin($resetpasswordkey));
        return mysqli_single_object(
            $mysqli,
            'select * from users'
            ." where idusers = $idusers"
            ." and resetpasswordkey = '$resetpasswordkey'"
        );
    }

    static function getByUsername ($username) {
        global $mysqli;
        $username = mysqli_real_escape_string($mysqli, $username);
        return mysqli_single_object(
            $mysqli,
            "select * from users where username = '$username'"
        );
    }

    static function getByUsernamePassword ($username, $password) {
        global $mysqli;
        $username = mysqli_real_escape_string($mysqli, $username);
        $password = mysqli_real_escape_string($mysqli, md5($password, true));
        return mysqli_single_object(
            $mysqli,
            'select * from users'
            ." where username = '$username' and password = '$password'"
        );
    }

    static function updateLastLoginTime ($idusers) {
        global $mysqli;
        $lastlogintime = time();
        mysqli_query(
            $mysqli,
            "update users set lastlogintime = $lastlogintime"
            ." where idusers = $idusers"
        );
    }

}
