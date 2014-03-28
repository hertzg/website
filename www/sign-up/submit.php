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

$errors = [];

include_once '../lib/mysqli.php';

include_once 'fns/check_username.php';
check_username($mysqli, $username, $errors);

include_once 'fns/check_email.php';
check_email($mysqli, $email, $errors);

include_once 'fns/check_passwords.php';
check_passwords($password1, $password2, $errors);

include_once '../fns/Captcha/check.php';
Captcha\check($errors);

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['sign-up/errors'] = $errors;
    $_SESSION['sign-up/values'] = [
        'username' => $username,
        'email' => $email,
        'password1' => $password1,
        'password2' => $password2,
    ];
    redirect();
}

unset(
    $_SESSION['sign-up/errors'],
    $_SESSION['sign-up/values']
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

$_SESSION['sign-in/messages'] = [
    'Thank you for signing up.',
    'Sign in to proceed.'
];

redirect('../sign-in/');
