<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

unset($_SESSION['sign-in/messages']);

include_once '../fns/request_strings.php';
list($username, $password, $remember, $return) = request_strings(
    'username', 'password', 'remember', 'return');

$remember = (bool)$remember;
$errors = [];

if ($remember) {
    include_once '../fns/Cookie/set.php';
    Cookie\set('remember', '1');
} else {
    include_once '../fns/Cookie/remove.php';
    Cookie\remove('remember');
}

if ($username === '') $errors[] = 'Enter username.';
else {
    include_once '../fns/Username/isValid.php';
    if (!Username\isValid($username)) $errors[] = 'The username is invalid.';
}

if ($password === '') $errors[] = 'Enter password.';

if (!$errors) {
    include_once '../fns/Session/authenticate.php';
    include_once '../lib/mysqli.php';
    $user = Session\authenticate($mysqli,
        $username, $password, $remember, $disabled);
    if (!$user) {
        if ($disabled) $error = 'Your account is disabled.';
        else $error = 'Invalid username or password.';
        $errors[] = $error;
    }
}

if ($errors) {
    $_SESSION['sign-in/errors'] = $errors;
    $_SESSION['sign-in/values'] = [
        'username' => $username,
        'password' => $password,
        'remember' => $remember,
        'return' => $return,
    ];
    include_once '../fns/redirect.php';
    redirect();
}

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/values']
);

include_once '../fns/Cookie/set.php';
Cookie\set('username', $user->username);

include_once 'fns/redirect_back.php';
redirect_back($user, $return);
