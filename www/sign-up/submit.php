<?php

include_once '../../lib/defaults.php';

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_guest_user.php';
require_guest_user('../');

include_once '../fns/redirect.php';

include_once '../fns/SignUpEnabled/get.php';
if (!SignUpEnabled\get()) redirect();

include_once '../fns/Username/request.php';
$username = Username\request();

include_once '../fns/request_strings.php';
list($password, $repeatPassword, $captcha, $return) = request_strings(
    'password', 'repeatPassword', 'captcha', 'return');

include_once '../fns/Email/request.php';
$email = Email\request();

include_once '../lib/mysqli.php';

include_once '../fns/check_username.php';
check_username($mysqli, $username, $errors, $focus);

include_once '../fns/check_passwords.php';
check_passwords($username, $password, $repeatPassword, $errors, $focus);

if ($email !== '') {
    include_once '../fns/Email/isValid.php';
    if (!Email\isValid($email)) {
        $errors[] = 'The email is invalid.';
        if ($focus === null) $focus = 'email';
    }
}

include_once '../fns/Captcha/check.php';
Captcha\check($errors, $focus);

if ($errors) {
    $_SESSION['sign-up/errors'] = $errors;
    $_SESSION['sign-up/values'] = [
        'focus' => $focus,
        'username' => $username,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
        'email' => $email,
        'return' => $return,
    ];
    redirect();
}

unset(
    $_SESSION['sign-up/errors'],
    $_SESSION['sign-up/values']
);

include_once '../fns/Users/Account/create.php';
Users\Account\create($mysqli, $username, $password, $email, false, false, true);

include_once '../fns/Captcha/reset.php';
Captcha\reset();

include_once '../fns/Cookie/set.php';
Cookie\set('username', $username);

include_once 'fns/send_email.php';
send_email($username);

$_SESSION['sign-in/messages'] = [
    'Thank you for creating an account.',
    'Sign in to proceed.'
];
unset($_SESSION['sign-in/errors']);

session_commit();

include_once '../fns/get_zvini_client.php';
get_zvini_client()->call('notification/post', [
    'channel_name' => 'zvini-signups',
    'text' => "$username has created an account.",
]);

if ($return === '') $queryString = '';
else $queryString = '?return='.rawurlencode($return);

redirect("../sign-in/$queryString");
