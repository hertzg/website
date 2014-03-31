<?php

function require_valid_token ($mysqli) {
    $token = null;
    if (array_key_exists('username', $_COOKIE) &&
        array_key_exists('token', $_COOKIE)) {
        $username = $_COOKIE['username'];
        $token_text = $_COOKIE['token'];
        if (is_string($username) && is_string($token_text)) {

            include_once __DIR__.'/hex2bin.php';
            $token_text = hex2bin($token_text);

            include_once __DIR__.'/Tokens/getByUsernameTokenText.php';
            $token = Tokens\getByUsernameTokenText($mysqli, $username, $token_text);

        }
    }
    return $token;
}
