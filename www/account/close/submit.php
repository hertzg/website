<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($password) = request_strings('password');

$errors = [];

if ($password === '') {
    $errors[] = 'Enter password.';
} else {
    include_once '../../fns/Password/match.php';
    $hash = $user->password_hash;
    $salt = $user->password_salt;
    if (!Password\match($hash, $salt, $password)) {
        $errors[] = 'Invalid password.';
    }
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['account/close/errors'] = $errors;
    redirect();
}

unset($_SESSION['account/close/errors']);

include_once 'fns/close_account.php';
include_once '../../lib/mysqli.php';
close_account($mysqli, $id_users);

$_SESSION['sign-in/messages'] = [
    'Your account has been closed.',
];

setcookie('username', '', time() - 60 * 60 * 24, '/');
redirect('../../sign-in/');
