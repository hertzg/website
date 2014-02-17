<?php

include_once 'lib/require-user.php';
include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['bookmarks/index_messages']);

$page->base = '../../';
$page->title = 'Delete All Bookmarks?';
$page->finish(
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '../..',
            ],
        ],
        'Bookmarks',
        Page::text('Are you sure you want to delete all the bookmarks?')
        .Page::HR
        .Page::imageLink(
            'Yes, delete all bookmarks',
            'submit.php',
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', '..', 'no')
    )
);
