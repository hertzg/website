<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/session_start_custom.php';
session_start_custom();

unset($_SESSION['sign-in/index_messages']);

include_once '../fns/request_strings.php';
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

    include_once '../fns/Users/getByUsernamePassword.php';
    include_once '../lib/mysqli.php';
    $user = Users\getByUsernamePassword($mysqli, $username, $password);

    if (!$user) {
        $errors[] = 'Invalid username or password.';
    }

}

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['sign-in/index_errors'] = $errors;
    $_SESSION['sign-in/index_lastpost'] = array(
        'username' => $username,
        'password' => $password,
        'remember' => $remember,
    );
    redirect();
}

unset(
    $_SESSION['sign-in/index_errors'],
    $_SESSION['sign-in/index_lastpost']
);

include_once '../fns/Users/updateLastLoginTime.php';
Users\updateLastLoginTime($mysqli, $user->idusers);

if ($remember) {

    $tokentext = md5(uniqid(), true);
    if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
    } else {
        $useragent = null;
    }

    include_once '../fns/Tokens/add.php';
    $idtokens = Tokens\add($mysqli, $user->idusers, $username, $tokentext, $useragent);

    include_once '../fns/Tokens/get.php';
    $token = Tokens\get($mysqli, $idtokens);

    if ($token) {
        setcookie('token', bin2hex($tokentext), time() + 60 * 60 * 24 * 30, '/');
        $_SESSION['token'] = $token;
    }

}

setcookie('username', $user->username, time() + 60 * 60 * 24 * 30, '/');

$_SESSION['user'] = $user;
redirect('../home/');
