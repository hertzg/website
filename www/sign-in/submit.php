<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once '../fns/request_strings.php';
include_once '../classes/Users.php';
include_once '../lib/session-start.php';

unset($_SESSION['sign-in_messages']);

list($username, $password, $remember) = request_strings(
    'username', 'password', 'remember');

$remember = (bool)$remember;
$errors = array();

if ($remember) {
    setcookie('remember', '1', time() + 60 * 60 * 24 * 30, '/');
} else {
    setcookie('remember', '', time() - 60 * 60 * 24, '/');
}

if ($username === '') $errors[] = 'Enter username.';

if ($password === '') $errors[] = 'Enter password.';

if (!$errors) {
    $user = Users::getByUsernamePassword($username, $password);
    if (!$user) {
        $errors[] = 'Invalid username or password.';
    }
}

if ($errors) {
    $_SESSION['sign-in_errors'] = $errors;
    $_SESSION['sign-in_lastpost'] = array(
        'username' => $username,
        'password' => $password,
        'remember' => $remember,
    );
    redirect();
}

unset(
    $_SESSION['sign-in_errors'],
    $_SESSION['sign-in_lastpost']
);

Users::updateLastLoginTime($user->idusers);

if ($remember) {
    include_once '../classes/Tokens.php';
    $tokentext = md5(uniqid(), true);
    if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
    } else {
        $useragent = null;
    }
    $idtokens = Tokens::add($user->idusers, $username, $tokentext, $useragent);
    $token = Tokens::get($idtokens);
    if ($token) {
        setcookie('token', bin2hex($tokentext), time() + 60 * 60 * 24 * 30, '/');
        $_SESSION['token'] = $token;
    }
}

setcookie('username', $user->username, time() + 60 * 60 * 24 * 30, '/');

$_SESSION['user'] = $user;
redirect('../home.php');
