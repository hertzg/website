<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

include_once '../fns/request_strings.php';
list($username, $email, $password1, $password2, $captcha) = request_strings(
    'username', 'email', 'password1', 'password2', 'captcha');

include_once '../fns/str_collapse_spaces.php';
$username = str_collapse_spaces($username);
$email = str_collapse_spaces($email);
$email = mb_strtolower($email, 'UTF-8');

$errors = array();

if ($username === '') {
    $errors[] = 'Enter username.';
} elseif (mb_strlen($username, 'UTF-8') < 6) {
    $errors[] = 'Username too short. At least 6 characters required.';
} else {
    include_once '../fns/Users/getByUsername.php';
    include_once '../lib/mysqli.php';
    if (Users\getByUsername($mysqli, $username)) {
        $errors[] = 'The username is unavailable. Try another.';
    }
}

if ($email === '') {
    $errors[] = 'Enter email.';
} else {
    include_once '../fns/is_email_valid.php';
    if (!is_email_valid($email)) {
        $errors[] = 'Enter a valid email address.';
    } else {
        include_once '../fns/Users/getByEmail.php';
        include_once '../lib/mysqli.php';
        if (Users\getByEmail($mysqli, $email)) {
            $errors[] = 'A username with this email is already registered. Try another.';
        }
    }
}

if ($password1 === '') {
    $errors[] = 'Enter password.';
} elseif (mb_strlen($password1, 'UTF-8') < 6) {
    $errors[] = 'Password too short. At least 6 characters required.';
} elseif ($password1 != $password2) {
    $errors[] = 'Passwords does not match.';
}

include_once '../fns/Captcha/check.php';
Captcha\check($errors);

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['sign-up/index_errors'] = $errors;
    $_SESSION['sign-up/index_lastpost'] = array(
        'username' => $username,
        'email' => $email,
        'password1' => $password1,
        'password2' => $password2,
    );
    redirect();
}

unset(
    $_SESSION['sign-up/index_errors'],
    $_SESSION['sign-up/index_lastpost']
);

include_once '../fns/Users/add.php';
Users\add($mysqli, $username, $email, $password1);

include_once '../fns/Captcha/reset.php';
Captcha\reset();

setcookie('username', $username, time() + 60 * 60 * 24 * 30, '/');

$text = "$username has signed up with the email $email";
include_once '../classes/ZviniAPI.php';
ZviniAPI::notify('zvini-signups', '03feb769e474c9c9c257597d462c41eb', $text);

include_once 'fns/send_email.php';
send_email($username, $email);

$_SESSION['sign-in/index_messages'] = array(
    'Thank you for signing up.',
    'Sign in to proceed.'
);

redirect('../sign-in/');
