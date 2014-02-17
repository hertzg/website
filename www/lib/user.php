<?php

include_once __DIR__.'/../fns/session_start_custom.php';
session_start_custom();

$user = $idusers = null;
if (!array_key_exists('user', $_SESSION)) {
    include_once 'token.php';
    if ($token) {

        include_once __DIR__.'/../fns/Users/get.php';
        include_once __DIR__.'/../lib/mysqli.php';
        $user = Users\get($mysqli, $token->idusers);

        if ($user) {
            $_SESSION['user'] = $user;
            $_SESSION['token'] = $token;
        }

    }
}
if (array_key_exists('user', $_SESSION)) {

    include_once __DIR__.'/../fns/Users/get.php';
    include_once __DIR__.'/../lib/mysqli.php';
    $user = Users\get($mysqli, $_SESSION['user']->idusers);

    if ($user) {
        setcookie('username', $user->username, time() + 60 * 60 * 24 * 30, '/');
        $idusers = $user->idusers;
        if (array_key_exists('token', $_SESSION)) {

            $token = $_SESSION['token'];
            setcookie('token', bin2hex($token->tokentext), time() + 60 * 60 * 24 * 30, '/');

            include_once __DIR__.'/../fns/Tokens/updateAccessTime.php';
            Tokens\updateAccessTime($mysqli, $token->tokentext);

        }
    }

}
