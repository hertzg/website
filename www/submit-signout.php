<?php

include_once 'fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/session_start_custom.php';
session_start_custom();

unset($_SESSION['user']);

if (array_key_exists('token', $_SESSION)) {

    include_once 'fns/Tokens/remove.php';
    include_once 'lib/mysqli.php';
    Tokens\remove($mysqli, $_SESSION['token']->idtokens);

    unset($_SESSION['token']);
    setcookie('token', '', time() - 60 * 60 * 24, '/');

}

$_SESSION['sign-in/index_messages'] = array(
    'You have been signed out.',
);

include_once 'fns/redirect.php';
redirect('sign-in/');
