<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'lib/require-user.php';
include_once 'fns/request_strings.php';
include_once 'classes/Users.php';

list($currentpassword, $password1, $password2) = request_strings(
    'currentpassword', 'password1', 'password2');

$errors = array();

unset($_SESSION['change-password_errors']);

if ($currentpassword === '') {
    $errors[] = 'Enter current password.';
} elseif (md5($currentpassword, true) != $user->password) {
    $errors[] = 'Invalid current password.';
}

if ($password1 === '') {
    $errors[] = 'Enter new password.';
} elseif (mb_strlen($password1, 'UTF-8') < 6) {
    $errors[] = 'New password too short. At least 6 characters required.';
} elseif ($password1 !== $password2) {
    $errors[] = 'New passwords does not match.';
}

if ($errors) {
    $_SESSION['change-password_errors'] = $errors;
    $_SESSION['change-password_lastpost'] = [
        'currentpassword' => $currentpassword,
        'password1' => $password1,
        'password2' => $password2,
    ];
    redirect('change-password.php');
}

Users::editPassword($idusers, $password1);

$_SESSION['account_messages'] = array('Password has been changed.');
redirect('account.php');
