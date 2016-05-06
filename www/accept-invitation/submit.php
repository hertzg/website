<?php

include_once '../../lib/defaults.php';

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once 'fns/request_invitation.php';
include_once '../lib/mysqli.php';
list($invitation, $key) = request_invitation($mysqli);

include_once '../fns/redirect.php';
if (!$invitation) redirect();

include_once '../fns/Username/request.php';
$username = Username\request();

include_once '../fns/request_strings.php';
list($password, $repeatPassword) = request_strings(
    'password', 'repeatPassword');

include_once '../fns/Email/request.php';
$email = Email\request();

$errors = [];

include_once '../fns/check_username.php';
check_username($mysqli, $username, $errors, $focus);

include_once '../fns/check_passwords.php';
check_passwords($username, $password, $repeatPassword, $errors, $focus);

include_once '../fns/check_email.php';
check_email($email, $errors, $focus);

if ($errors) {
    $_SESSION['accept-invitation/errors'] = $errors;
    $_SESSION['accept-invitation/values'] = [
        'focus' => $focus,
        'username' => $username,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
        'email' => $email,
    ];
    redirect("./?key=$key");
}

unset(
    $_SESSION['accept-invitation/errors'],
    $_SESSION['accept-invitation/values']
);

include_once '../fns/Users/Account/create.php';
Users\Account\create($mysqli, $username,
    $password, $email, '', 0, false, false, false);

include_once '../fns/Invitations/delete.php';
Invitations\delete($mysqli, $invitation->id);

include_once '../fns/Cookie/set.php';
Cookie\set('username', $username);

include_once 'fns/send_email.php';
send_email($username);

$_SESSION['sign-in/values'] = [
    'focus' => 'button',
    'username' => $username,
    'password' => $password,
    'remember' => array_key_exists('remember', $_COOKIE),
    'return' => '',
];
$_SESSION['sign-in/messages'] = [
    'Thank you for accepting the invitation.',
    'Sign in to proceed.',
];
unset($_SESSION['sign-in/errors']);

session_commit();

include_once '../fns/get_zvini_client.php';
get_zvini_client()->call('notification/post', [
    'channel_name' => 'zvini-signups',
    'text' => "$username has accepted an invitation.",
]);

redirect('../sign-in/');
