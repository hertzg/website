<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

unset($_SESSION['sign-in/messages']);

include_once '../fns/request_strings.php';
list($username, $password, $remember, $return) = request_strings(
    'username', 'password', 'remember', 'return');

$remember = (bool)$remember;
$errors = [];

if ($remember) {
    setcookie('remember', '1', time() + 60 * 60 * 24 * 30, '/');
} else {
    setcookie('remember', '', time() - 60 * 60 * 24, '/');
}

if ($username === '') $errors[] = 'Enter username.';

if ($password === '') $errors[] = 'Enter password.';

if (!$errors) {

    include_once '../fns/Users/getByUsernameAndPassword.php';
    include_once '../lib/mysqli.php';
    $user = Users\getByUsernameAndPassword($mysqli, $username, $password);

    if (!$user) {
        $errors[] = 'Invalid username or password.';
    }

}

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['sign-in/errors'] = $errors;
    $_SESSION['sign-in/values'] = [
        'username' => $username,
        'password' => $password,
        'remember' => $remember,
    ];
    redirect();
}

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/values']
);

$idusers = $user->idusers;

include_once '../fns/Users/login.php';
Users\login($mysqli, $idusers);

if ($user->password_salt === '') {
    include_once '../fns/Users/editPassword.php';
    Users\editPassword($mysqli, $idusers, $password);
}

if ($remember) {
    include_once 'fns/remember_session.php';
    remember_session($mysqli, $user);
}

setcookie('username', $user->username, time() + 60 * 60 * 24 * 30, '/');

$_SESSION['user'] = $user;

if (parse_url($return, PHP_URL_HOST) !== null) $return = '';

if ($return == '') {
    include_once '../fns/nth_order.php';
    $_SESSION['home/messages'] = [
        'Welcome to Zvini!',
        'This is your '.nth_order($user->num_logins + 1).' login.',
    ];
    $return = '../home/';
}

redirect($return);
