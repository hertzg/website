<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

include_once '../fns/request_strings.php';
list($return) = request_strings('return');

$key = 'sign-in/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    if (array_key_exists('username', $_COOKIE)) {
        $username = $_COOKIE['username'];
        if (!is_string($username)) $username = '';
    } else {
        $username = '';
    }

    $values = [
        'username' => $username,
        'password' => '',
        'remember' => array_key_exists('remember', $_COOKIE),
    ];

}

unset(
    $_SESSION['sign-up/errors'],
    $_SESSION['sign-up/values'],
    $_SESSION['email-reset-password/errors'],
    $_SESSION['email-reset-password/values']
);

$username = $values['username'];

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/checkbox.php';
include_once '../fns/Form/hidden.php';
include_once '../fns/Form/password.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/imageLinkWithDescription.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        [],
        'Sign In',
        Page\sessionMessages('sign-in/messages')
        .Page\sessionErrors('sign-in/errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('username', 'Username', [
                'value' => $username,
                'autofocus' => $username === '',
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\password('password', 'Password', [
                'value' => $values['password'],
                'autofocus' => $username !== '',
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\checkbox($base, 'remember', 'Stay signed in', $values['remember'])
            .'<div class="hr"></div>'
            .Form\button('Sign In')
            .Form\hidden('return', $return)
        .'</form>'
        .create_panel(
            'Options',
            Page\imageLinkWithDescription('Forgot password?',
                'Reset your account password here.', '../email-reset-password/',
                'reset-password')
            .'<div class="hr"></div>'
            .Page\imageLinkWithDescription('Don\'t have an account?',
                'Sign up here.', '../sign-up/', 'new-password')
        )
    );

include_once '../fns/echo_guest_page.php';
echo_guest_page('Sign In', $content, $base);
