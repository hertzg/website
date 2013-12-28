<?php

include_once 'classes/Form.php';
include_once 'classes/Tab.php';
include_once 'lib/page.php';
include_once 'lib/session-start.php';

if (array_key_exists('signup_lastpost', $_SESSION)) {
    $values = $_SESSION['signup_lastpost'];
} else {
    $values = array(
        'username' => '',
        'email' => '',
        'password1' => '',
        'password2' => '',
    );
}

if (array_key_exists('signup_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['signup_errors']);
} else {
    $pageErrors = '';
}

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
        .Tab::activeItem('Sign Up'),
        $pageErrors
        .Form::create(
            'submit-signup.php',
            Form::textfield('username', 'Username', array(
                'value' => $values['username'],
                'autofocus' => true,
                'required' => true,
            ))
            .Form::notes(array('Minimum 6 characters.'))
            .Page::HR
            .Form::textfield('email', 'Email', array(
                'value' => $values['email'],
                'required' => true,
            ))
            .Page::HR
            .Form::password('password1', 'Password', array(
                'value' => $values['password1'],
                'required' => true,
            ))
            .Form::notes(array('Minimum 6 characters.'))
            .Page::HR
            .Form::password('password2', 'Repeat password', array(
                'value' => $values['password2'],
                'required' => true,
            ))
            .Page::HR
            .Form::captcha()
            .Form::button('Sign Up')
        )
    )
);
