<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

include_once 'fns/require_valid_key.php';
include_once '../lib/mysqli.php';
list($user, $key) = require_valid_key($mysqli);
$idusers = $user->idusers;

include_once '../fns/request_strings.php';
list($password1, $password2) = request_strings('password1', 'password2');

$errors = array();

if ($password1 === '') {
    $errors[] = 'Enter new password.';
} else {
    include_once '../fns/Password/isShort.php';
    if (Password\isShort($password1)) {

        include_once '../fns/Password/minLength.php';
        $minLength = Password\minLength();

        $errors[] = "New password should be at least $minLength characters long.";

    } elseif ($password1 !== $password2) {
        $errors[] = 'New passwords does not match.';
    }
}

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['reset-password/index_errors'] = $errors;
    $_SESSION['reset-password/index_values'] = array(
        'password1' => $password1,
        'password2' => $password2,
    );
    redirect("./?idusers=$idusers&key=$key");
}

unset(
    $_SESSION['reset-password/index_errors'],
    $_SESSION['reset-password/index_values']
);

include_once '../fns/Users/editPassword.php';
Users\editPassword($mysqli, $idusers, $password1);

setcookie('username', $user->username, time() + 60 * 60 * 24 * 30, '/');

$_SESSION['sign-in/index_messages'] = array(
    'Password has been reset.',
    'You can sign in with your new password.'
);
redirect('../sign-in/');
