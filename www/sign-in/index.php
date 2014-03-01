<?php

include_once '../lib/user.php';
if ($user) {
    include_once '../fns/redirect.php';
    redirect('../home/');
}

include_once '../fns/create_panel.php';
include_once '../classes/Form.php';
include_once '../lib/page.php';

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

if (array_key_exists('sign-in/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['sign-in/index_errors']);
} else {
    $pageErrors = '';
}

if (array_key_exists('sign-in/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['sign-in/index_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['sign-up/index_errors'],
    $_SESSION['sign-up/index_lastpost'],
    $_SESSION['email-reset-password/index_errors'],
    $_SESSION['email-reset-password/index_lastpost']
);

$username = $values['username'];

$base = '../';

include_once '../fns/create_tabs.php';

$page->base = $base;
$page->hideSignOutLink = true;
$page->title = 'Sign In';
$page->finish(
    create_tabs(
        array(),
        'Sign In', 
        $pageMessages
        .$pageErrors
        .Form::create(
            'submit.php',
            Form::textfield('username', 'Username', array(
                'value' => $username,
                'autofocus' => $username === '',
                'required' => true,
            ))
            .Page::HR
            .Form::password('password', 'Password', array(
                'value' => $values['password'],
                'autofocus' => $username !== '',
                'required' => true,
            ))
            .Page::HR
            .Form::checkbox($base, 'remember', 'Stay signed in', $values['remember'])
            .Page::HR
            .Form::button('Sign In')
        )
        .create_panel(
            'Options',
            Page::imageArrowLinkWithDescription('Forgot password?',
                'Reset your account password here.', '../email-reset-password/',
                'reset-password')
            .Page::HR
            .Page::imageArrowLinkWithDescription('Don\'t have an account?',
                'Sign up here.', '../sign-up/', 'new-password')
        )
    )
);
