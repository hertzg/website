<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'lib/session-start.php';

unset($_SESSION['user']);

if (array_key_exists('token', $_SESSION)) {
    include_once 'classes/Tokens.php';
    Tokens::remove($_SESSION['token']->idtokens);
    unset($_SESSION['token']);
    setcookie('token', '', time() - 60 * 60 * 24, '/');
}

$_SESSION['signin_messages'] = array(
    'You have been signed out.',
);

redirect('sign-in/');
