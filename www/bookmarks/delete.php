<?php

include_once 'lib/require-bookmark.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

$page->base = '../';
$page->title = 'Delete Bookmark?';
$page->finish(
    Tab::create(
        Tab::item('Bookmarks', './')
        .Tab::activeItem('View'),
        Page::text('Are you sure you want to delete the bookmark?')
        .Page::HR
        .Page::imageLink(
            'Yes, delete bookmark',
            "submit-delete.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "view.php?id=$id", 'no')
    )
);
