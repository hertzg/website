<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'fns/request_strings.php';
include_once 'classes/Users.php';
include_once 'lib/session-start.php';

list($username, $password, $remember) = request_strings(
    'username', 'password', 'remember');

$remember = (bool)$remember;
$errors = array();

if ($username === '') $errors[] = 'Enter username.';

if ($password === '') $errors[] = 'Enter password.';

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
    $_SESSION['signin_lastpost'] = array(
        'username' => $username,
        'password' => $password,
        'remember' => $remember,
    );
    redirect('signin.php');
}

Users::updateLastLoginTime($user->idusers);

if ($remember) {
    include_once 'classes/Tokens.php';
    $tokentext = md5(uniqid(), true);
    $idtokens = Tokens::add($user->idusers, $username, $tokentext);
    $token = Tokens::get($idtokens);
    if ($token) {
        setcookie('token', bin2hex($tokentext), time() + 60 * 60 * 24 * 30, '/');
        $_SESSION['token'] = $token;
    }
}

setcookie('username', $user->username, time() + 60 * 60 * 24 * 30, '/');

$_SESSION['user'] = $user;
redirect('home.php');
