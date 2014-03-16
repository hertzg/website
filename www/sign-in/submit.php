<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

unset($_SESSION['sign-in/index_messages']);

include_once '../fns/request_strings.php';
list($username, $password, $remember, $return) = request_strings(
    'username', 'password', 'remember', 'return');

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

include_once '../fns/Users/login.php';
Users\login($mysqli, $user->idusers);

if ($remember) {
    include_once 'fns/remember_session.php';
    remember_session($mysqli, $user);
}

setcookie('username', $user->username, time() + 60 * 60 * 24 * 30, '/');

$_SESSION['user'] = $user;

if (parse_url($return, PHP_URL_HOST) !== null) $return = '';

if ($return == '') {
    include_once '../fns/nth_order.php';
    $_SESSION['home/index_messages'] = array(
        'Welcome to Zvini!',
        'This is your '.nth_order($user->num_logins + 1).' login.',
    );
    $return = '../home/';
}

redirect($return);
