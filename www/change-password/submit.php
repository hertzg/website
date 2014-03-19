<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
$user = require_user('../');
$idusers = $user->idusers;

include_once '../fns/request_strings.php';
list($currentpassword, $password1, $password2) = request_strings(
    'currentpassword', 'password1', 'password2');

$errors = array();

if ($currentpassword === '') {
    $errors[] = 'Enter current password.';
} else {
    include_once '../fns/Password/match.php';
    if (!Password\match($user->password_hash, $currentpassword)) {
        $errors[] = 'Invalid current password.';
    }
}

if ($password1 === '') {
    $errors[] = 'Enter new password.';
} else {
    include_once '../fns/Password/isShort.php';
    if (Password\isShort($password1)) {
        include_once '../fns/Password/minLength.php';
        $errors[] =
            'New password too short.'
            .' At least '.Password\minLength().' characters required.';
    } elseif ($password1 !== $password2) {
        $errors[] = 'New passwords does not match.';
    }
}

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['change-password/index_errors'] = $errors;
    $_SESSION['change-password/index_lastpost'] = array(
        'currentpassword' => $currentpassword,
        'password1' => $password1,
        'password2' => $password2,
    );
    redirect();
}

unset(
    $_SESSION['change-password/index_errors'],
    $_SESSION['change-password/index_lastpost']
);

include_once '../fns/Users/editPassword.php';
include_once '../lib/mysqli.php';
Users\editPassword($mysqli, $idusers, $password1);

$_SESSION['account/index_messages'] = array('Password has been changed.');
redirect('../account/');
