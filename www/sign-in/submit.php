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
    include_once '../fns/Cookie/set.php';
    Cookie\set('remember', '1');
} else {
    include_once '../fns/Cookie/remove.php';
    Cookie\remove('remember');
}

if ($username === '') $errors[] = 'Enter username.';
else {
    include_once '../fns/Username/isValid.php';
    if (!Username\isValid($username)) $errors[] = 'The username is invalid.';
}

if ($password === '') $errors[] = 'Enter password.';

if (!$errors) {

    include_once '../fns/Users/getByUsernameAndPassword.php';
    include_once '../lib/mysqli.php';
    $user = Users\getByUsernameAndPassword($mysqli, $username, $password);

    if (!$user) {

        $errors[] = 'Invalid username or password.';

        include_once '../fns/get_client_address.php';
        include_once '../fns/InvalidSignins/add.php';
        InvalidSignins\add($mysqli, $username, get_client_address());

    }

}

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['sign-in/errors'] = $errors;
    $_SESSION['sign-in/values'] = [
        'username' => $username,
        'password' => $password,
        'remember' => $remember,
        'return' => $return,
    ];
    redirect();
}

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/values']
);

$id_users = $user->id_users;

include_once '../fns/Users/login.php';
Users\login($mysqli, $id_users);

if ($user->password_salt === '') {
    include_once '../fns/Users/editPassword.php';
    Users\editPassword($mysqli, $id_users, $password);
}

if ($remember) {
    include_once 'fns/remember_session.php';
    remember_session($mysqli, $user);
}

include_once '../fns/Cookie/set.php';
Cookie\set('username', $user->username);

$_SESSION['user'] = $user;

if (parse_url($return, PHP_URL_HOST) !== null) $return = '';

if ($return == '') {
    $num_logins = $user->num_logins;
    if ($num_logins) {
        include_once '../fns/nth_order.php';
        $order = nth_order($user->num_logins + 1);
        $message = "Welcome back! This is your $order login.";
    } else {
        $message = 'Welcome to Zvini!';
    }
    $_SESSION['home/messages'] = [$message];
    $return = '../home/';
}

redirect($return);
