<?php

include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';
include_once '../lib/session-start.php';

if (array_key_exists('email-reset-password/index_lastpost', $_SESSION)) {
    $values = $_SESSION['email-reset-password/index_lastpost'];
} else {
    $values = array('email' => '');
}

if (array_key_exists('email-reset-password/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['email-reset-password/index_errors']);
} else {
    $pageErrors = '';
}

unset(
    $_SESSION['sign-in/index_errors'],
    $_SESSION['sign-in/index_lastpost'],
    $_SESSION['sign-in/index_messages']
);

$base = '../';

$page->base = $base;
$page->hideSignOutLink = true;
$page->title = 'Reset Password';
$page->finish(
    Tab::create(
        Tab::item('Sign In', '../sign-in/')
        .Tab::activeItem('Reset Password'),
        $pageErrors
        .Form::create(
            'submit.php',
            Form::textfield('email', 'Email', array(
                'value' => $values['email'],
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::captcha($base)
            .Form::button('Send Recovery Email')
        )
    )
);
