<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

include_once 'fns/require_valid_key.php';
include_once '../lib/mysqli.php';
list($user, $key) = require_valid_key($mysqli);
$id_users = $user->id_users;

if (!$user->email_verified) {
    include_once '../fns/Users/verifyEmail.php';
    Users\verifyEmail($mysqli, $id_users);
}

include_once 'fns/get_values.php';
$values = get_values();

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/values'],
    $_SESSION['sign-in/messages']
);

include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/hidden.php';
include_once '../fns/Form/label.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
include_once '../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        [
            [
                'title' => 'Sign In',
                'href' => '../sign-in/',
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
