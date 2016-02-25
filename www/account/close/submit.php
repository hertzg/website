<?php

include_once '../../../lib/defaults.php';

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
    $match = Password\match($user->password_hash, $user->password_salt,
        $user->password_sha512_hash, $user->password_sha512_key, $password);

    if (!$match) $errors[] = 'Invalid password.';

}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['account/close/errors'] = $errors;
    $_SESSION['account/close/values'] = ['password' => $password];
    redirect();
}

unset(
    $_SESSION['account/close/errors'],
    $_SESSION['account/close/values']
);

include_once "$fnsDir/Users/Account/Close/close.php";
include_once '../../lib/mysqli.php';
Users\Account\Close\close($mysqli, $user);

unset($_SESSION['user']);

$_SESSION['sign-in/messages'] = ['Your account has been closed.'];
unset($_SESSION['sign-in/errors']);

include_once "$fnsDir/Cookie/remove.php";
Cookie\remove('username');

redirect('../../sign-in/');
