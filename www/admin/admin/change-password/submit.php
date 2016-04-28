<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../../fns/require_admin.php';
require_admin();

include_once "$fnsDir/request_strings.php";
list($password, $repeatPassword) = request_strings(
    'password', 'repeatPassword');

$errors = [];

if ($password === '') {
    $errors[] = 'Enter new password.';
    $focus = 'password';
} else {
    include_once "$fnsDir/Password/isShort.php";
    if (Password\isShort($password)) {
        include_once "$fnsDir/Password/minLength.php";
        $minLength = Password\minLength();
        $errors[] = 'Password too short.'
            ." At least $minLength characters required.";
        $focus = 'password';
    } else {

        include_once "$fnsDir/Admin/get.php";
        Admin\get($username, $hash, $salt, $sha512_hash, $sha512_key);

        if ($password === $username) {
            $errors[] = 'Please, choose a password'
                .' that is different from the username.';
            $focus = 'password';
        } elseif ($password !== $repeatPassword) {
            $errors[] = 'New passwords does not match.';
            $focus = 'repeatPassword';
        }

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
    $_SESSION['admin/admin/change-password/errors'] = $errors;
    $_SESSION['admin/admin/change-password/values'] = [
        'focus' => $focus,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
    ];
    redirect();
}

unset(
    $_SESSION['admin/admin/change-password/errors'],
    $_SESSION['admin/admin/change-password/values']
);

$_SESSION['admin/admin/messages'] = ['Password has been changed.'];
redirect('..');
