<?php

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
list($password1, $password2) = request_strings('password1', 'password2');

$errors = [];

if ($password1 === '') {
    $errors[] = 'Enter new password.';
} else {
    include_once '../fns/Password/isShort.php';
    if (Password\isShort($password1)) {

        include_once '../fns/Password/minLength.php';
        $minLength = Password\minLength();

        $errors[] = 'New password should be'
            ." at least $minLength characters long.";

    } elseif ($password1 === $user->username) {
        $errors[] = 'Please, choose a password'
            .' that is different from your username.';
    } elseif ($password1 !== $password2) {
        $errors[] = 'New passwords does not match.';
    }
}

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['reset-password/errors'] = $errors;
    $_SESSION['reset-password/values'] = [
        'password1' => $password1,
        'password2' => $password2,
    ];
    redirect("./?id_users=$id_users&key=".bin2hex($key));
}

unset(
    $_SESSION['reset-password/errors'],
    $_SESSION['reset-password/values']
);

include_once '../fns/Users/editPassword.php';
Users\editPassword($mysqli, $id_users, $password1);

include_once '../fns/Cookie/set.php';
Cookie\set('username', $user->username);

$_SESSION['sign-in/messages'] = [
    'Password has been reset.',
    'You can sign in with your new password.'
];
unset($_SESSION['sign-in/errors']);

$return = $user->reset_password_return;

if ($return === '') $queryString = '';
else $queryString = '?return='.rawurlencode($return);

redirect("../sign-in/$queryString");
