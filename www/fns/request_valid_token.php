<?php

function request_valid_token ($mysqli) {

    if (!array_key_exists('username', $_COOKIE) ||
        !array_key_exists('token', $_COOKIE)) return;

    $username = $_COOKIE['username'];
    $token_text = $_COOKIE['token'];

    if (!is_string($username) && !is_string($token_text)) return;

    include_once __DIR__.'/is_md5.php';
    if (!is_md5($token_text)) return;

    $token_text = hex2bin($token_text);

    include_once __DIR__.'/Tokens/getByUsernameTokenText.php';
    $token = Tokens\getByUsernameTokenText($mysqli, $username, $token_text);

    if (!$token) return;

    $key = 'HTTP_USER_AGENT';
    if (array_key_exists($key, $_SERVER)) $user_agent = $_SERVER[$key];
    else $user_agent = null;

    if ($token->user_agent !== $user_agent) return;

    return $token;

}
