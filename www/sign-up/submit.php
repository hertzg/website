<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

include_once '../fns/request_strings.php';
list($username, $password1, $password2, $captcha) = request_strings(
    'username', 'password1', 'password2', 'captcha');

include_once '../fns/str_collapse_spaces.php';
$username = str_collapse_spaces($username);

$errors = [];

include_once '../lib/mysqli.php';

include_once '../fns/check_username.php';
check_username($mysqli, $username, $errors);

include_once 'fns/check_passwords.php';
check_passwords($username, $password1, $password2, $errors);

include_once '../fns/Captcha/check.php';
Captcha\check($errors);

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['sign-up/errors'] = $errors;
    $_SESSION['sign-up/values'] = [
        'username' => $username,
        'password1' => $password1,
        'password2' => $password2,
    ];
    redirect();
}

unset(
    $_SESSION['sign-up/errors'],
    $_SESSION['sign-up/values']
);

include_once '../fns/Users/add.php';
Users\add($mysqli, $username, $password1);

include_once '../fns/Captcha/reset.php';
Captcha\reset();

include_once '../fns/Cookie/set.php';
Cookie\set('username', $username);

$text = "$username has signed up.";

include_once 'fns/send_email.php';
send_email($username);

$_SESSION['sign-in/messages'] = [
    'Thank you for signing up.',
    'Sign in to proceed.'
];

session_commit();

include_once '../fns/get_zvini_client.php';
get_zvini_client()->call('notification/post', [
    'channel_name' => 'zvini-signups',
    'text' => $text,
]);

redirect('../sign-in/');
