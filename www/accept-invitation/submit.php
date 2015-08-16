<?php

include_once 'fns/require_invitation.php';
include_once '../lib/mysqli.php';
list($invitation, $key, $id) = require_invitation($mysqli);

include_once '../fns/request_strings.php';
list($username, $password, $repeatPassword, $email) = request_strings(
    'username', 'password', 'repeatPassword', 'email');

include_once '../fns/str_collapse_spaces.php';
$username = str_collapse_spaces($username);

$errors = [];

include_once '../fns/check_username.php';
check_username($mysqli, $username, $errors);

include_once '../fns/check_passwords.php';
check_passwords($username, $password, $repeatPassword, $errors);

if ($email !== '') {
    include_once '../fns/Email/isValid.php';
    if (!Email\isValid($email)) $errors[] = 'The email is invalid.';
}

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['accept-invitation/errors'] = $errors;
    $_SESSION['accept-invitation/values'] = [
        'username' => $username,
        'password' => $password,
        'repeatPassword' => $repeatPassword,
        'email' => $email,
    ];
    redirect("./?id=$id&key=".bin2hex($key));
}

unset(
    $_SESSION['accept-invitation/errors'],
    $_SESSION['accept-invitation/values']
);

include_once '../fns/Users/Account/create.php';
Users\Account\create($mysqli, $username, $password, $email);

include_once '../fns/Invitations/delete.php';
Invitations\delete($mysqli, $id);

include_once '../fns/Cookie/set.php';
Cookie\set('username', $username);

$text = "$username has accepted an invitation.";

include_once 'fns/send_email.php';
send_email($username);

$_SESSION['sign-in/messages'] = [
    'Thank you for accepting the invitation.',
    'Sign in to proceed.'
];
unset($_SESSION['sign-in/errors']);

session_commit();

include_once '../fns/get_zvini_client.php';
get_zvini_client()->call('notification/post', [
    'channel_name' => 'zvini-signups',
    'text' => $text,
]);

redirect('../sign-in/');
