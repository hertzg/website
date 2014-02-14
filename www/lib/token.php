<?php

$token = null;
if (array_key_exists('username', $_COOKIE) &&
    array_key_exists('token', $_COOKIE)) {
    $username = $_COOKIE['username'];
    $tokentext = $_COOKIE['token'];
    if (is_string($username) && is_string($tokentext)) {
        include_once __DIR__.'/../fns/hex2bin.php';
        include_once __DIR__.'/../fns/Tokens/getByUsernameTokenText.php';
        include_once __DIR__.'/../lib/mysqli.php';
        $token = Tokens\getByUsernameTokenText($mysqli, $username, hex2bin($tokentext));
    }
    unset($username, $tokentext);
}
