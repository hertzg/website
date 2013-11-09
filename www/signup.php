<?php

include_once 'fns/ifset.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';
include_once 'lib/session-start.php';

$lastpost = ifset($_SESSION['signup_lastpost']);

unset(
    $_SESSION['signin_errors'],
    $_SESSION['signin_lastpost'],
    $_SESSION['signin_messages'],
    $_SESSION['email-reset-password_errors'],
    $_SESSION['email-reset-password_lastpost']
);

$page->hideSignOutLink = true;
$page->title = 'Sign Up';
$page->finish(
    Tab::create(
        Tab::item('Sign In', 'signin.php')
        .Tab::activeItem('Sign Up')
        .Tab::item('Reset Password', 'email-reset-password.php')
    )
    .Page::errors(ifset($_SESSION['signup_errors']))
    .Form::create(
        'submit-signup.php',
        Form::textfield('username', 'Username', array(
            'value' => ifset($lastpost['username']),
            'autofocus' => true,
            'required' => true,
        ))
        .Form::notes(array('Minimum 6 characters.'))
        .Page::HR
        .Form::textfield('email', 'Email', array(
            'value' => ifset($lastpost['email']),
            'required' => true,
        ))
        .Page::HR
        .Form::password('password1', 'Password', array(
            'value' => ifset($lastpost['password1']),
            'required' => true,
        ))
        .Form::notes(array('Minimum 6 characters.'))
        .Page::HR
        .Form::password('password2', 'Repeat password', array(
            'value' => ifset($lastpost['password2']),
            'required' => true,
        ))
        .Page::HR
        .Form::captcha()
        .Form::button('Sign Up')
    )
);
