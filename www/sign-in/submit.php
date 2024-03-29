<?php

include_once '../../lib/defaults.php';

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

unset($_SESSION['sign-in/messages']);

include_once '../fns/Username/request.php';
$username = Username\request();

include_once '../fns/request_strings.php';
list($password, $remember, $return) = request_strings(
    'password', 'remember', 'return');

$remember = (bool)$remember;
$errors = [];
$focus = null;

if ($remember) {
    include_once '../fns/Cookie/set.php';
    Cookie\set('remember', '1');
} else {
    include_once '../fns/Cookie/remove.php';
    Cookie\remove('remember');
}

if ($username === '') {
    $errors[] = 'ENTER_USERNAME';
    $focus = 'username';
} else {
    include_once '../fns/Username/isValid.php';
    if (!Username\isValid($username)) {
        $errors[] = 'INVALID_USERNAME';
        $focus = 'username';
    }
}

if ($password === '') {
    $errors[] = 'ENTER_PASSWORD';
    if ($focus !== null) $focus = 'password';
}

if (!$errors) {
    include_once '../fns/Session/authenticate.php';
    include_once '../lib/mysqli.php';
    $user = Session\authenticate($mysqli, $username,
        $password, $remember, $disabled, $rate_limited);
    if (!$user) {
        if ($disabled) {
            $error = 'USER_DISABLED';
            $focus = 'username';
        } elseif ($rate_limited) {
            $error = 'RATE_LIMITED';
            $focus = 'button';
        } else {
            $error = 'INVALID_USERNAME_OR_PASSWORD';
            $focus = 'password';
        }
        $errors[] = $error;
    }
}

if ($errors) {
    $_SESSION['sign-in/errors'] = $errors;
    $_SESSION['sign-in/values'] = [
        'focus' => $focus,
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
