<?php

include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';
include_once 'lib/session-start.php';

if (array_key_exists('email-reset-password_lastpost', $_SESSION)) {
    $values = $_SESSION['email-reset-password_lastpost'];
} else {
    $values = array('email' => '');
}

if (array_key_exists('email-reset-password_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['email-reset-password_errors']);
} else {
    $pageErrors = '';
}

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
        .Tab::activeItem('Reset Password'),
        $pageErrors
        .Form::create(
            'submit-email-reset-password.php',
            Form::textfield('email', 'Email', array(
                'value' => $values['email'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::captcha()
            .Form::button('Send Recovery Email')
        )
    )
);
