<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

if (array_key_exists('close-account_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['close-account_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['notifications_messages']);

$page->base = '../';
$page->title = 'Close Account';
$page->finish(
    Tab::create(
        Tab::item('Account', '../account/')
        .Tab::activeItem('Close'),
        $pageErrors
        .Page::warnings(array(
            'Are you sure you want to close your account?',
            ' You will lose all your data.',
        ))
        .Form::create(
            'submit.php',
            Form::password('password', 'Password', array(
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::button('Close Account')
        )
    )
);
