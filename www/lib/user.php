<?php

include_once 'session-start.php';
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
            include_once __DIR__.'/../classes/Tokens.php';
            Tokens::updateAccessTime($token->tokentext);
            setcookie('token', bin2hex($token->tokentext), time() + 60 * 60 * 24 * 30, '/');
        }
    }

}
