<?php

include_once '../fns/require_guest_user.php';
require_guest_user('../');

include_once '../classes/Form.php';
include_once '../lib/page.php';

if (array_key_exists('email-reset-password/index_lastpost', $_SESSION)) {
    $values = $_SESSION['email-reset-password/index_lastpost'];
} else {
    $values = array('email' => '');
}

include_once '../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('email-reset-password/index_errors');

unset(
    $_SESSION['sign-in/index_errors'],
    $_SESSION['sign-in/index_lastpost'],
    $_SESSION['sign-in/index_messages']
);

$base = '../';

include_once '../fns/create_tabs.php';

$page->base = $base;
$page->hideSignOutLink = true;
$page->title = 'Reset Password';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Sign In',
                'href' => '../sign-in/',
            ),
        ),
        'Reset Password',
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
