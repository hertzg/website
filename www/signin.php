<?php

include_once 'fns/ifset.php';
include_once 'fns/redirect.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';
include_once 'lib/user.php';

if ($user) redirect('home.php');

$lastpost = ifset($_SESSION['signin_lastpost']);

unset(
    $_SESSION['signup_errors'],
    $_SESSION['signup_lastpost'],
    $_SESSION['email-reset-password_errors'],
    $_SESSION['email-reset-password_lastpost']
);
$username = ifset($lastpost['username'], ifset($_COOKIE['username'], ''));

$page->hideSignOutLink = true;
$page->title = 'Sign In';
$page->finish(
    Tab::create(
        Tab::activeItem('Sign In')
        .Tab::item('Sign Up', 'signup.php')
        .Tab::item('Reset Password', 'email-reset-password.php')
    )
    .Page::messages(ifset($_SESSION['signin_messages']))
    .Page::errors(ifset($_SESSION['signin_errors']))
    .Form::create(
        'submit-signin.php',
        Form::textfield('username', 'Username', array(
            'value' => $username,
            'autofocus' => $username === '',
        ))
        .Page::HR
        .Form::password('password', 'Password', array(
            'value' => ifset($lastpost['password']),
            'autofocus' => $username !== '',
        ))
        .Page::HR
        .Form::button('Sign In')
    )
);
