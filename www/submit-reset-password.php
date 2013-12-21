<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'fns/is_md5.php';
include_once 'fns/request_strings.php';
include_once 'classes/Users.php';
include_once 'lib/session-start.php';

list($idusers, $resetpasswordkey, $password1, $password2) = request_strings(
    'idusers', 'resetpasswordkey', 'password1', 'password2');

if (!is_md5($resetpasswordkey)) redirect();

$user = Users::getByResetPasswordKey($idusers, $resetpasswordkey);
if (!$user) redirect();

unset($_SESSION['user']);

$errors = array();

if ($password1 === '') {
    $errors[] = 'Enter new password.';
} elseif (mb_strlen($password1, 'UTF-8') < 6) {
    $errors[] = 'New password should be at least 6 characters long.';
} elseif ($password1 != $password2) {
    $errors[] = 'New passwords does not match.';
}

unset(
    $_SESSION['reset-password_errors'],
    $_SESSION['reset-password_lastpost']
);

if ($errors) {
    $_SESSION['reset-password_errors'] = $errors;
    $_SESSION['reset-password_lastpost'] = $_POST;
    redirect(
        "reset-password.php?idusers=$idusers&resetpasswordkey=$resetpasswordkey"
    );
}

Users::editPassword($idusers, $password1);
setcookie('username', $user->username, time() + 7 * 25 * 60 * 60);

$_SESSION['signin_messages'] = array(
    'Password has been reset.',
    'You can sign in with your new password.'
);
redirect('signin.php');
