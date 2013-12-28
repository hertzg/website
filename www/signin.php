<?php

include_once 'lib/user.php';
if ($user) {
        include_once 'fns/redirect.php';
    redirect('home.php');
}

include_once 'fns/create_panel.php';
include_once 'classes/Form.php';
include_once 'classes/Tab.php';
include_once 'lib/page.php';

if (array_key_exists('signin_lastpost', $_SESSION)) {
    $values = $_SESSION['signin_lastpost'];
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

if (array_key_exists('signin_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['signin_errors']);
} else {
    $pageErrors = '';
}

if (array_key_exists('signin_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['signin_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['signup_errors'],
    $_SESSION['signup_lastpost'],
    $_SESSION['email-reset-password_errors'],
    $_SESSION['email-reset-password_lastpost']
);

$username = $values['username'];

$page->hideSignOutLink = true;
$page->title = 'Sign In';
$page->finish(
    Tab::create(
        Tab::activeItem('Sign In')
        .Tab::item('Sign Up', 'signup.php'),
        $pageMessages
        .$pageErrors
        .Form::create(
            'submit-signin.php',
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
            .Form::checkbox('remember', 'Stay signed in', $values['remember'])
            .Page::HR
            .Form::button('Sign In')
        )
        .create_panel(
            'Options',
            Page::imageLink('Reset Password', 'email-reset-password.php', 'reset-password')
        )
    )
);
