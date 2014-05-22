<?php

function require_valid_token ($mysqli) {
    $token = null;
    if (array_key_exists('username', $_COOKIE) &&
        array_key_exists('token', $_COOKIE)) {
        $username = $_COOKIE['username'];
        $token_text = $_COOKIE['token'];
        if (is_string($username) && is_string($token_text)) {

            $token_text = hex2bin($token_text);

            include_once __DIR__.'/Tokens/getByUsernameTokenText.php';
            $token = Tokens\getByUsernameTokenText(
                $mysqli, $username, $token_text);

            if ($token) {

                $key = 'HTTP_USER_AGENT';
                if (array_key_exists($key, $_SERVER)) {
                    $user_agent = $_SERVER[$key];
                } else {
                    $user_agent = null;
                }

                if ($token->user_agent !== $user_agent) $token = null;

            }

        }
    }
    return $token;
}
