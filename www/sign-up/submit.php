<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Captcha.php';
include_once '../classes/Users.php';
include_once '../lib/session-start.php';

list($username, $email, $password1, $password2, $captcha) = request_strings(
    'username', 'email', 'password1', 'password2', 'captcha');

$username = str_collapse_spaces($username);
$email = str_collapse_spaces($email);
$email = mb_strtolower($email, 'UTF-8');

$errors = array();

if ($username === '') {
    $errors[] = 'Enter username.';
} elseif (mb_strlen($username, 'UTF-8') < 6) {
    $errors[] = 'Username too short. At least 6 characters required.';
} elseif (Users::getByUsername($username)) {
    $errors[] = 'The username is unavailable. Try another.';
}

if ($email === '') {
    $errors[] = 'Enter email.';
} else {
    include_once '../fns/is_email_valid.php';
    if (!is_email_valid($email)) {
        $errors[] = 'Enter a valid email address.';
    } else if (Users::getByEmail($email)) {
        $error[] = 'A username with this email is already registered. Try another.';
    }
}

if ($password1 === '') {
    $errors[] = 'Enter password.';
} elseif (mb_strlen($password1, 'UTF-8') < 6) {
    $errors[] = 'Password too short. At least 6 characters required.';
} elseif ($password1 != $password2) {
    $errors[] = 'Passwords does not match.';
}

Captcha::check($errors, 3);

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

Users::add($username, $email, $password1);
Captcha::reset();
setcookie('username', $username, time() + 60 * 60 * 24 * 30, '/');

$escapedUsername = htmlspecialchars($username);
$notificationText = "$escapedUsername has signed up with the email ".htmlspecialchars($email);
include_once '../classes/ZviniAPI.php';
ZviniAPI::notify('zvini-signups', '03feb769e474c9c9c257597d462c41eb', $notificationText);

$title = "$escapedUsername Signed Up";

mail(
    'info@zvini.com',
    $title,
    '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            ."<title>$title</title>"
            .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
        .'</head>'
        ."<body>$notificationText</body>"
    .'</html>',
    "From: no-reply@zvini.com\r\n"
    .'Content-Type: text/html; charset=UTF-8'
);

$_SESSION['sign-in/index_messages'] = array(
    'Thank you for signing up.',
    'Sign in to proceed.'
);
redirect('../sign-in/');
