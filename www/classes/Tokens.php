<?php

include_once __DIR__.'/../fns/mysqli_single_object.php';
include_once __DIR__.'/../lib/mysqli.php';

class Tokens {

    static function add ($idusers, $username, $tokentext, $useragent) {
        global $mysqli;
        $username = mysqli_real_escape_string($mysqli, $username);
        $tokentext = mysqli_real_escape_string($mysqli, $tokentext);
        $inserttime = $accesstime = time();
        if ($useragent === null) {
            $useragent = 'null';
        } else {
            $useragent = "'".mysqli_real_escape_string($mysqli, $useragent)."'";
        }
        mysqli_query(
            $mysqli,
            'insert into tokens (idusers, username, tokentext, useragent,'
            .' inserttime, accesstime)'
            ." values ($idusers, '$username', '$tokentext', $useragent,"
            ." $inserttime, $accesstime)"
        );
        return mysqli_insert_id($mysqli);
    }

    static function countOnUser ($idusers) {
        global $mysqli;
        return mysqli_single_object(
            $mysqli,
            "select count(*) count from tokens where idusers = $idusers"
        )->count;
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
