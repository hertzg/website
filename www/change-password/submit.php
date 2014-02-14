<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'lib/require-user.php';
include_once '../classes/Users.php';

include_once '../fns/request_strings.php';
list($currentpassword, $password1, $password2) = request_strings(
    'currentpassword', 'password1', 'password2');

$errors = array();

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
