<?php

include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Tokens {

    static function add ($idusers, $username, $tokentext) {
        global $mysqli;
        $username = mysqli_real_escape_string($mysqli, $username);
        $tokentext = mysqli_real_escape_string($mysqli, $tokentext);
        $inserttime = $accesstime = time();
        mysqli_query(
            $mysqli,
            'insert into tokens (idusers, username, tokentext,'
            .' inserttime, accesstime)'
            ." values ($idusers, '$username', '$tokentext',"
            ." $inserttime, $accesstime)"
        );
        return mysqli_insert_id($mysqli);
    }

    static function delete ($id) {
        global $mysqli;
        mysqli_query($mysqli, "delete from tokens where idtokens = $id");
    }

    static function deleteOnUser ($idusers) {
        global $mysqli;
        mysqli_query($mysqli, "delete from tokens where idusers = $idusers");
    }

    static function get ($id) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select * from tokens where idtokens = $id"
        );
    }

    static function getByUsernameTokenText ($username, $tokentext) {
        global $mysqli;
        $username = mysqli_real_escape_string($mysqli, $username);
        $tokentext = mysqli_real_escape_string($mysqli, $tokentext);
        return mysqli_single_object(
            $mysqli,
            'select * from tokens'
            ." where username = '$username' and tokentext = '$tokentext'"
        );
    }

    static function getOnUser ($idusers, $id) {
        $token = self::get($id);
        if ($token && $token->idusers == $idusers) return $token;
    }

    static function indexOnUser ($idusers) {
        global $mysqli;
        include_once __DIR__.'/../fns/mysqli_query_object.php';
        return mysqli_query_object(
            $mysqli,
            'select * from tokens'
            ." where idusers = $idusers"
            .' order by tokentext'
        );
    }

    static function remove ($id) {
        global $mysqli;
        mysqli_query($mysqli, "delete from tokens where idtokens = $id");
    }

    static function updateAccessTime ($id) {
        global $mysqli;
        $accesstime = time();
        mysqli_query(
            $mysqli,
            'update tokens set'
            ." accesstime = $accesstime"
            ." where idtokens = $id"
        );
    }

}
