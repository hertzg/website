<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($currentpassword, $password1, $password2) = request_strings(
    'currentpassword', 'password1', 'password2');

$errors = [];

if ($currentpassword === '') {
    $errors[] = 'Enter current password.';
} else {
    include_once '../../fns/Password/match.php';
    $hash = $user->password_hash;
    $salt = $user->password_salt;
    if (!Password\match($hash, $salt, $currentpassword)) {
        $errors[] = 'Invalid current password.';
    }
}

if ($password1 === '') {
    $errors[] = 'Enter new password.';
} else {
    include_once '../../fns/Password/isShort.php';
    if (Password\isShort($password1)) {
        include_once '../../fns/Password/minLength.php';
        $errors[] =
            'New password too short.'
            .' At least '.Password\minLength().' characters required.';
    } elseif ($password1 !== $password2) {
        $errors[] = 'New passwords does not match.';
    }
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['account/change-password/errors'] = $errors;
    $_SESSION['account/change-password/values'] = [
        'currentpassword' => $currentpassword,
        'password1' => $password1,
        'password2' => $password2,
    ];
    redirect();
}

unset(
    $_SESSION['account/change-password/errors'],
    $_SESSION['account/change-password/values']
);

include_once '../../fns/Users/editPassword.php';
include_once '../../lib/mysqli.php';
Users\editPassword($mysqli, $id_users, $password1);

$_SESSION['account/messages'] = ['Password has been changed.'];
redirect('..');
