<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

include_once 'fns/require_valid_key.php';
include_once '../lib/mysqli.php';
list($user, $key, $id_users) = require_valid_key($mysqli);

if (!$user) {
    include_once '../fns/echo_alert_page.php';
    echo_alert_page('Link Expired',
        'The link has expired. You should try again to reset your password.',
        '..', $base);
}

if (!$user->email_verified) {
    include_once '../fns/Users/Email/verify.php';
    Users\Email\verify($mysqli, $id_users);
}

include_once 'fns/get_values.php';
$values = get_values();

$return = $user->reset_password_return;

if ($return === '') $queryString = '';
else $queryString = '?return='.rawurlencode($return);

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/messages'],
    $_SESSION['sign-in/values']
);

include_once '../fns/Form/button.php';
include_once '../fns/Form/hidden.php';
include_once '../fns/Form/label.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Sign In',
            'href' => "../sign-in/$queryString#email-reset-password",
        ],
    ],
    'Reset Password',
    Page\sessionErrors('reset-password/errors')
    .'<form action="submit.php" method="post">'
        .Form\label('Username', $user->username)
        .'<div class="hr"></div>'
        .Form\password('password1', 'New password', [
            'value' => $values['password1'],
            'autofocus' => true,
            'required' => true,
        ])
        .Form\notes(['Minimum 6 characters.'])
        .'<div class="hr"></div>'
        .Form\password('password2', 'Repeat new password', [
            'value' => $values['password2'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Reset Password')
        .Form\hidden('id_users', $id_users)
        .Form\hidden('key', $key)
    .'</form>'
);

include_once '../fns/echo_page.php';
echo_page($user, 'Reset Password', $content, $base);
