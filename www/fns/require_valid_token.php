<?php

function require_valid_token ($mysqli) {
    $token = null;
    if (array_key_exists('username', $_COOKIE) &&
        array_key_exists('token', $_COOKIE)) {
        $username = $_COOKIE['username'];
        $tokentext = $_COOKIE['token'];
        if (is_string($username) && is_string($tokentext)) {

            include_once __DIR__.'/hex2bin.php';
            $tokentext = hex2bin($tokentext);

            include_once __DIR__.'/Tokens/getByUsernameTokenText.php';
            $token = Tokens\getByUsernameTokenText($mysqli, $username, $tokentext);

        }
    }
    return $token;
}
