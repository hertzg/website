<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['bookmarks/index_messages']);

$page->base = '../../';
$page->title = 'Delete All Bookmarks?';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../..',
            ),
        ),
        'Bookmarks',
        Page::text('Are you sure you want to delete all the bookmarks?')
        .Page::HR
        .Page::imageLink('Yes, delete all bookmarks', 'submit.php', 'yes')
        .Page::HR
        .Page::imageLink('No, return back', '..', 'no')
    )
);
