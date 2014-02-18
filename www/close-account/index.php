<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../classes/Form.php';
include_once '../lib/page.php';

if (array_key_exists('close-account/index_errors', $_SESSION)) {
    $pageErrors = Page::errors($_SESSION['close-account/index_errors']);
} else {
    $pageErrors = '';
}

unset($_SESSION['account/index_messages']);

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Close Account';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Account',
                'href' => '../account/',
            ),
        ),
        'Close',
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
