<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/session_start_custom.php';
session_start_custom();

if (array_key_exists('token', $_SESSION)) {

    $token = $_SESSION['token'];

    include_once '../fns/Tokens/delete.php';
    include_once 'lib/mysqli.php';
    Tokens\delete($mysqli, $token->id);

    include_once '../fns/Users/Tokens/addNumber.php';
    Users\Tokens\addNumber($mysqli, $token->id_users, -1);

    setcookie('token', '', time() - 60 * 60 * 24, '/');

}

session_destroy();
session_start_custom();

$_SESSION['sign-in/messages'] = ['You have been signed out.'];

include_once '../fns/redirect.php';
redirect('../sign-in/');