<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/request_strings.php";
list($password) = request_strings('password');

$errors = [];

if ($password === '') {
    $errors[] = 'Enter password.';
} else {
    include_once "$fnsDir/Password/match.php";
    $hash = $user->password_hash;
    $salt = $user->password_salt;
    if (!Password\match($hash, $salt, $password)) {
        $errors[] = 'Invalid password.';
    }
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['account/close/errors'] = $errors;
    redirect();
}

unset($_SESSION['account/close/errors']);

include_once "$fnsDir/Users/Account/Close/close.php";
include_once '../../lib/mysqli.php';
Users\Account\Close\close($mysqli, $user);

unset($_SESSION['user']);

$_SESSION['sign-in/messages'] = ['Your account has been closed.'];
unset($_SESSION['sign-in/errors']);

include_once "$fnsDir/Cookie/remove.php";
Cookie\remove('username');

redirect('../../sign-in/');
