<?php

function request_valid_token ($mysqli, $array = null) {

    if ($array === null) $array = $_COOKIE;

    if (!array_key_exists('username', $array) ||
        !array_key_exists('token', $array)) return;

    $username = $array['username'];
    $token_text = $array['token'];

    if (!is_string($username) && !is_string($token_text)) return;

    $token_text = @hex2bin($token_text);
    if ($token_text === false) return;

    include_once __DIR__.'/Tokens/getByUsernameTokenText.php';
    $token = Tokens\getByUsernameTokenText($mysqli, $username, $token_text);

    return $token;

}
