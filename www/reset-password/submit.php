<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

include_once '../fns/session_start_custom.php';
session_start_custom();

include_once '../fns/request_strings.php';
list($idusers, $resetpasswordkey, $password1, $password2) = request_strings(
    'idusers', 'resetpasswordkey', 'password1', 'password2');

include_once '../fns/is_md5.php';
if (!is_md5($resetpasswordkey)) redirect();

$idusers = abs((int)$idusers);

include_once '../fns/Users/getByResetPasswordKey.php';
include_once '../lib/mysqli.php';
$user = Users\getByResetPasswordKey($mysqli, $idusers, $resetpasswordkey);

include_once '../fns/redirect.php';

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

if ($errors) {
    $_SESSION['reset-password/index_errors'] = $errors;
    $_SESSION['reset-password/index_lastpost'] = array(
        'password1' => $password1,
        'password2' => $password2,
    );
    redirect("./?idusers=$idusers&resetpasswordkey=$resetpasswordkey");
}

unset(
    $_SESSION['reset-password/index_errors'],
    $_SESSION['reset-password/index_lastpost']
);

include_once '../fns/Users/editPassword.php';
include_once '../lib/mysqli.php';
Users\editPassword($mysqli, $idusers, $password1);

setcookie('username', $user->username, time() + 60 * 60 * 24 * 30, '/');

$_SESSION['sign-in/index_messages'] = array(
    'Password has been reset.',
    'You can sign in with your new password.'
);
redirect('../sign-in/');
