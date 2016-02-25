<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once "$fnsDir/request_strings.php";
list($currentPassword, $password, $repeatPassword) = request_strings(
    'currentPassword', 'password', 'repeatPassword');

$errors = [];
$focus = null;

if ($currentPassword === '') {
    $errors[] = 'Enter current password.';
    $focus = 'currentPassword';
} else {

    include_once "$fnsDir/Password/match.php";
    $match = Password\match($user->password_hash,
        $user->password_salt, $user->password_sha512_hash,
        $user->password_sha512_key, $currentPassword);

    if (!$match) {
        $errors[] = 'Invalid current password.';
        $focus = 'currentPassword';
    }

}

if ($password === '') {
    $errors[] = 'Enter new password.';
    if ($focus === null) $focus = 'password';
} else {
    include_once "$fnsDir/Password/isShort.php";
    if (Password\isShort($password)) {
        include_once "$fnsDir/Password/minLength.php";
        $errors[] =
            'New password too short.'
            .' At least '.Password\minLength().' characters required.';
        if ($focus === null) $focus = 'password';
    } elseif ($password === $user->username) {
        $errors[] = 'Please, choose a password'
            .' that is different from your username.';
        if ($focus === null) $focus = 'password';
    } elseif ($password !== $repeatPassword) {
        $errors[] = 'New passwords does not match.';
        if ($focus === null) $focus = 'repeatPassword';
    }
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['account/change-password/errors'] = $errors;
    $_SESSION['account/change-password/values'] = [
        'focus' => $focus,
        'currentPassword' => $currentPassword,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
    ];
    redirect();
}

unset(
    $_SESSION['account/change-password/errors'],
    $_SESSION['account/change-password/values']
);

include_once "$fnsDir/Users/changePassword.php";
include_once '../../lib/mysqli.php';
Users\changePassword($mysqli, $user, $currentPassword, $password);

$_SESSION['account/messages'] = ['Password has been changed.'];
redirect('..');
