<?php

$token = null;
if (array_key_exists('username', $_COOKIE) &&
    array_key_exists('token', $_COOKIE)) {
    $username = $_COOKIE['username'];
    $tokentext = $_COOKIE['token'];
    if (is_string($username) && is_string($tokentext)) {
        include_once __DIR__.'/../classes/Tokens.php';
        $token = Tokens::getByUsernameTokenText($username, hex2bin($tokentext));
    }
    unset($username, $tokentext);
}
