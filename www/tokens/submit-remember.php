<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
$user = require_user('../');
$idusers = $user->idusers;

include_once '../fns/require_valid_token.php';
include_once '../lib/mysqli.php';
$token = require_valid_token($mysqli);

if (!$token) {

    $tokentext = md5(uniqid(), true);
    if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
    } else {
        $useragent = null;
    }

    include_once '../fns/Tokens/add.php';
    $idtokens = Tokens\add($mysqli, $user->idusers, $user->username, $tokentext, $useragent);

    include_once '../fns/Users/addNumTokens.php';
    Users\addNumTokens($mysqli, $idusers, 1);

    include_once '../fns/Tokens/get.php';
    $token = Tokens\get($mysqli, $idtokens);

    if ($token) {
        setcookie('token', bin2hex($tokentext), time() + 60 * 60 * 24 * 30, '/');
        $_SESSION['token'] = $token;
    }

}

$_SESSION['tokens/index_messages'] = array(
    'Current session has been remembered.',
);

include_once '../fns/redirect.php';
redirect();
