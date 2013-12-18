<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'fns/request_strings.php';
include_once 'classes/Users.php';
include_once 'lib/session-start.php';

list($username, $password) = request_strings('username', 'password');

$errors = array();

if (!$username) {
    $errors[] = 'Enter username.';
}

if (!$password) {
    $errors[] = 'Enter password.';
}

if (!$errors) {
    $user = Users::getByUsernamePassword($username, $password);
    if (!$user) {
        $errors[] = 'Invalid username or password.';
    }
}

unset(
    $_SESSION['signin_errors'],
    $_SESSION['signin_lastpost'],
    $_SESSION['signin_messages']
);

if ($errors) {
    $_SESSION['signin_errors'] = $errors;
    $_SESSION['signin_lastpost'] = $_POST;
    redirect('signin.php');
}

$_SESSION['user'] = $user;
redirect('home.php');
