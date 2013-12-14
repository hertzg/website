<?php

include_once 'lib/require-user.php';
include_once 'fns/ifset.php';
include_once 'fns/redirect.php';
include_once 'classes/Form.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';

unset($_SESSION['notifications_messages']);

$page->title = 'Close Account';
$page->finish(
    Tab::create(
        Tab::item('Account', 'account.php')
        .Tab::activeItem('Close'),
        Page::errors(ifset($_SESSION['close-account_errors']))
        .Page::warnings(array(
            'Are you sure you want to close your account?',
            ' You will lose all your data.',
        ))
        .Form::create(
            'submit-close-account.php',
            Form::password('password', 'Password', array(
                'autofocus' => true,
                'required' => true,
            ))
            .Page::HR
            .Form::button('Close Account')
        )
    )
);
