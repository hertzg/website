<?php

function remember_session ($mysqli, $user) {

    $tokentext = md5(uniqid(), true);
    if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
    } else {
        $useragent = null;
    }

    $idusers = $user->idusers;

    include_once '../fns/Tokens/add.php';
    $idtokens = Tokens\add($mysqli, $idusers, $user->username,
        $tokentext, $useragent);

    include_once '../fns/Users/addNumTokens.php';
    Users\addNumTokens($mysqli, $idusers, 1);

    include_once '../fns/Tokens/get.php';
    $token = Tokens\get($mysqli, $idtokens);

    if ($token) {
        setcookie('token', bin2hex($tokentext), time() + 60 * 60 * 24 * 30, '/');
        $_SESSION['token'] = $token;
    }

}
