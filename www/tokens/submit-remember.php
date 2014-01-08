<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../lib/token.php';

if (!$token) {
    include_once '../classes/Tokens.php';
    $tokentext = md5(uniqid(), true);
    if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
    } else {
        $useragent = null;
    }
    $idtokens = Tokens::add($user->idusers, $user->username, $tokentext, $useragent);
    $token = Tokens::get($idtokens);
    if ($token) {
        setcookie('token', bin2hex($tokentext), time() + 60 * 60 * 24 * 30, '/');
        $_SESSION['token'] = $token;
    }
}

$_SESSION['tokens/index_messages'] = array('Current session has been remembered.');

redirect();
