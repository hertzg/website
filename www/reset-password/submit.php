<?php

include_once '../../lib/defaults.php';

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once 'fns/require_valid_key.php';
include_once '../lib/mysqli.php';
list($user, $key, $id_users) = require_valid_key($mysqli);

if (!$user) {
    include_once '../fns/redirect.php';
    redirect("./?id_users=$id_users&key=".bin2hex($key));
}

include_once '../fns/request_strings.php';
list($password, $repeatPassword) = request_strings(
    'password', 'repeatPassword');

include_once '../fns/check_reset_passwords.php';
check_reset_passwords($user->username,
    $password, $repeatPassword, $errors, $focus);

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['reset-password/errors'] = $errors;
    $_SESSION['reset-password/values'] = [
        'focus' => $focus,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
    ];
    redirect("./?id_users=$id_users&key=".bin2hex($key));
}

unset(
    $_SESSION['reset-password/errors'],
    $_SESSION['reset-password/values']
);

include_once '../fns/Users/resetPassword.php';
Users\resetPassword($mysqli, $id_users, $password);

include_once '../fns/Cookie/set.php';
Cookie\set('username', $user->username);

$_SESSION['sign-in/values'] = [
    'focus' => 'button',
    'username' => $user->username,
    'password' => $password,
    'remember' => array_key_exists('remember', $_COOKIE),
    'return' => $user->reset_password_return,
];
$_SESSION['sign-in/messages'] = [
    'Password has been reset.',
    'Sign in with your new password to proceed.',
];
unset($_SESSION['sign-in/errors']);

redirect('../sign-in/');
