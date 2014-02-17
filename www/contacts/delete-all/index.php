<?php

include_once 'lib/require-user.php';
include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['contacts/index_messages']);

$page->base = '../../';
$page->title = 'Delete All Contacts?';
$page->finish(
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '../..',
            ],
        ],
        'Contacts',
        Page::text('Are you sure you want to delete all the contacts?')
        .Page::HR
        .Page::imageLink(
            'Yes, delete all contacts',
            'submit.php',
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', '..', 'no')
    )
);
