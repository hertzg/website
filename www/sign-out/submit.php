<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/session_start_custom.php';
session_start_custom();

if (array_key_exists('token', $_SESSION)) {

    $token = $_SESSION['token'];

    include_once '../fns/Tokens/get.php';
    include_once '../lib/mysqli.php';
    $token = Tokens\get($mysqli, $token->id);

    if ($token) {

        include_once '../fns/Tokens/delete.php';
        Tokens\delete($mysqli, $token->id);

        include_once '../fns/Users/Tokens/addNumber.php';
        Users\Tokens\addNumber($mysqli, $token->id_users, -1);

    }

    include_once '../fns/Cookie/remove.php';
    Cookie\remove('token');

}

session_destroy();
session_start_custom();

$_SESSION['sign-in/messages'] = ['You have been signed out.'];
unset($_SESSION['sign-in/errors']);

include_once '../fns/redirect.php';
redirect('../sign-in/');
