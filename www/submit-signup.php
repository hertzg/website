<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'fns/request_strings.php';
include_once 'fns/str_collapse_spaces.php';
include_once 'classes/Captcha.php';
include_once 'classes/Users.php';
include_once 'lib/session-start.php';

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
    include_once 'fns/is_email_valid.php';
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

unset(
    $_SESSION['signup_errors'],
    $_SESSION['signup_lastpost']
);
Captcha::check($errors, 3);

if ($errors) {
    $_SESSION['signup_errors'] = $errors;
    $_SESSION['signup_lastpost'] = array(
        'username' => $username,
        'email' => $email,
        'password1' => $password1,
        'password2' => $password2,
    );
    redirect('signup.php');
}

Users::add($username, $email, $password1);
Captcha::reset();
setcookie('username', $username, time() + 60 * 60 * 24 * 30, '/');

$_SESSION['signin_messages'] = array(
    'Thank you for signing up.',
    'Sign in to proceed.'
);
redirect('signin.php');
