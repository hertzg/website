<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_admin.php';
require_admin();

include_once "$fnsDir/Username/request.php";
$username = Username\request();

include_once "$fnsDir/request_strings.php";
list($password, $repeatPassword) = request_strings(
    'password', 'repeatPassword');

include_once 'fns/check_username.php';
check_username($username, $errors, $focus);

if ($password === '') {
    $errors[] = 'Enter new password.';
    if ($focus === null) $focus = 'password';
} else {
    include_once "$fnsDir/Password/isShort.php";
    if (Password\isShort($password)) {
        include_once "$fnsDir/Password/minLength.php";
        $minLength = Password\minLength();
        $errors[] = 'Password too short.'
            ." At least $minLength characters required.";
        if ($focus === null) $focus = 'password';
    } elseif ($password === $username) {
        $errors[] = 'Please, choose a password'
            .' that is different from the username.';
        if ($focus === null) $focus = 'password';
    } elseif ($password !== $repeatPassword) {
        $errors[] = 'New passwords does not match.';
        if ($focus === null) $focus = 'repeatPassword';
    }
}

if (!$errors) {

    include_once "$fnsDir/Password/hash.php";
    list($sha512_hash, $sha512_key) = Password\hash($password);

    include_once "$fnsDir/Admin/set.php";
    $ok = Admin\set($username, $sha512_hash, $sha512_key);
    if ($ok === false) {
        $errors[] = 'Failed to save the data.';
        $focus = 'button';
    }
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/username-password/values'] = [
        'focus' => $focus,
        'username' => $username,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
    ];
    $_SESSION['admin/username-password/errors'] = $errors;
    redirect();
}

$_SESSION['admin/messages'] = ['Password has been changed.'];
redirect('..');
