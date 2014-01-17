<?php

include_once 'lib/require-user.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = 'Delete All Bookmarks?';
$page->finish(
    Tab::create(
        Tab::activeItem('Bookmarks'),
        Page::text('Are you sure you want to delete all the bookmarks?')
        .Page::HR
        .Page::imageLink(
            'Yes, delete all bookmarks',
            'submit.php',
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', '../', 'no')
    )
);
