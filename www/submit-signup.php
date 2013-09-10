<?php

include_once 'fns/redirect.php';
include_once 'fns/request_strings.php';
include_once 'classes/Captcha.php';
include_once 'classes/Users.php';
include_once 'lib/session-start.php';

list($username, $email, $password1, $password2, $captcha) = request_strings(
    'username', 'email', 'password1', 'password2', 'captcha');

$email = mb_strtolower($email, 'UTF-8');

$errors = array();

if (!$username) {
    $errors[] = 'Enter username.';
} elseif (mb_strlen($username, 'UTF-8') < 6) {
    $errors[] = 'Username too short. At least 6 characters required.';
} elseif (Users::getByUsername($username)) {
    $errors[] = 'The username is unavailable. Try another.';
}

if (!$email) {
    $errors[] = 'Enter email.';
} elseif (!preg_match("/^[a-z0-9][a-z0-9._-]*@[a-z0-9][a-z0-9.-]*[a-z0-9]\.[a-z.]+$/u", $email)) {
    $errors[] = 'Enter a valid email address.';
} else if (Users::getByEmail($email)) {
    $error[] = 'A username with this email is already registered. Try another.';
}

if (!$password1) {
    $errors[] = 'Enter password.';
} elseif (mb_strlen($password1, 'UTF-8') < 6) {
    $errors[] = 'Password too short. At least 6 characters required.';
} elseif ($password1 != $password2) {
    $errors[] = 'Passwords does not match.';
}

unset(
    $_SESSION['signup_errors'],
    $_SESSION['signup_lastpost']
);
Captcha::check($errors, 3);

if ($errors) {
    $_SESSION['signup_errors'] = $errors;
    $_SESSION['signup_lastpost'] = $_POST;
    redirect('signup.php');
}

Users::add($username, $email, $password1);
Captcha::reset();
setcookie('username', $username, time() + 7 * 25 * 60 * 60);

$_SESSION['signin_messages'] = array(
    'Thank you for signing up.',
    'Sign in to proceed.'
);
redirect('signin.php');
