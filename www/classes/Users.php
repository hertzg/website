<?php

include_once __DIR__.'/../fns/hex2bin.php';
include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../fns/mysqli_sprintf.php';
include_once __DIR__.'/../lib/mysqli.php';

class Users {

    static function add ($username, $email, $password) {

        global $mysqli;

        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'insert into users (username, email, password)'
                ." values ('#s', '#s', '#s')",
                array($username, $email, md5($password, true))
            )
        );

        $idusers = mysqli_insert_id($mysqli);
        mkdir("users/$idusers");

    }

    static function addNumNotifications ($idusers, $numnotifications) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update users set numnotifications = numnotifications + #u'
                .' where idusers = #u',
                array($numnotifications, $idusers)
            )
        );
    }

    static function clearNumNotifications ($idusers) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update users set numnotifications = 0'
                .' where idusers = #u',
                array($idusers)
            )
        );
    }

    static function delete ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from users where idusers = $idusers");
        rmdir("users/$idusers");
    }

    static function editPassword ($idusers, $password) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update users set'
                ." password = '#s',"
                .' resetpasswordkey = null'
                .' where idusers = #u',
                array(md5($password, true), $idusers)
            )
        );
    }

    static function editProfile ($idusers, $email, $fullname) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update users set'
                ." email = '#s',"
                ." fullname = '#s'"
                ." where idusers = #u",
                array($email, $fullname, $idusers)
            )
        );
    }

    static function editResetPasswordKey ($idusers, $resetpasswordkey) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                "update users set resetpasswordkey = '#s'"
                .' where idusers = #u',
                array($resetpasswordkey, $idusers)
            )
        );
    }

    static function editTheme ($idusers, $theme) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                "update users set theme = '#s' where idusers = #u",
                array($theme, $idusers)
            )
        );
    }

    static function get ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from users where idusers = #u',
                array($idusers)
            )
        );
    }

    static function getByEmail ($email, $excludeidusers = 0) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from users'
                ." where email = '#s' and idusers != #u",
                array($email, $excludeidusers)
            )
        );
    }

    static function getByResetPasswordKey ($idusers, $resetpasswordkey) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from users'
                ." where idusers = #u and resetpasswordkey = '#s'",
                array($idusers, hex2bin($resetpasswordkey))
            )
        );
    }

    static function getByUsername ($username) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                "select * from users where username = '#s'",
                array($username)
            )
        );
    }

    static function getByUsernamePassword ($username, $password) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'select * from users'
                ." where username = '#s' and password = '#s'",
                array($username, md5($password, true))
            )
        );
    }

    static function updateLastLoginTime ($idusers) {
        global $mysqli;
        mysqli_query(
            $mysqli,
            mysqli_sprintf(
                $mysqli,
                'update users set lastlogintime = #u'
                .' where idusers = #u',
                array(time(), $idusers)
            )
        );
    }

}
