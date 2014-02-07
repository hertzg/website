<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../classes/Form.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

if (array_key_exists('close-account/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['close-account/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['account/index_messages']);

$page->base = '../';
$page->title = 'Close Account';
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '..')
        .Tab::item('Account', '../account/')
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
