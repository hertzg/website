<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

if (array_key_exists('sign-in/index_lastpost', $_SESSION)) {
    $values = $_SESSION['sign-in/index_lastpost'];
} else {

    if (array_key_exists('username', $_COOKIE)) {
        $username = $_COOKIE['username'];
        if (!is_string($username)) $username = '';
    } else {
        $username = '';
    }

    $values = array(
        'username' => $username,
        'password' => '',
        'remember' => array_key_exists('remember', $_COOKIE),
    );

}

unset(
    $_SESSION['sign-up/index_errors'],
    $_SESSION['sign-up/index_lastpost'],
    $_SESSION['email-reset-password/index_errors'],
    $_SESSION['email-reset-password/index_lastpost']
);

$username = $values['username'];

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/checkbox.php';
include_once '../fns/Form/password.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/imageLinkWithDescription.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(),
        'Sign In',
        Page\sessionMessages('sign-in/index_messages')
        .Page\sessionErrors('sign-in/index_errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('username', 'Username', array(
                'value' => $username,
                'autofocus' => $username === '',
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\password('password', 'Password', array(
                'value' => $values['password'],
                'autofocus' => $username !== '',
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\checkbox($base, 'remember', 'Stay signed in', $values['remember'])
            .'<div class="hr"></div>'
            .Form\button('Sign In')
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
