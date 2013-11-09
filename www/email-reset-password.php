<?php

include_once 'fns/ifset.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';
include_once 'lib/session-start.php';

$lastpost = ifset($_SESSION['email-reset-password_lastpost']);

unset(
    $_SESSION['signin_errors'],
    $_SESSION['signin_lastpost'],
    $_SESSION['signin_messages'],
    $_SESSION['signup_errors'],
    $_SESSION['signup_lastpost']
);

$page->hideSignOutLink = true;
$page->title = 'Reset Password';
$page->finish(
    Tab::create(
        Tab::item('Sign In', 'signin.php')
        .Tab::item('Sign Up', 'signup.php')
        .Tab::activeItem('Reset Password')
    )
    .Page::errors(ifset($_SESSION['email-reset-password_errors']))
    .Form::create(
        'submit-email-reset-password.php',
        Form::textfield('email', 'Email', array(
            'value' => ifset($lastpost['email']),
            'autofocus' => true,
            'required' => true,
        ))
        .Page::HR
        .Form::captcha()
        .Form::button('Send Recovery Email')
    )
);
