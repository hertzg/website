<?php

include_once 'lib/require-user.php';
include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['notifications/index_messages']);

$page->base = '../../';
$page->title = 'Delete All Notifications?';
$page->finish(
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '../..',
            ],
        ],
        'Notifications',
        Page::text('Are you sure you want to delete all the notifications?')
        .Page::HR
        .Page::imageLink(
            'Yes, delete all notifications',
            'submit.php',
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', '..', 'no')
    )
);
