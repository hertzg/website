<?php

include_once 'lib/require-bookmark.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

unset($_SESSION['bookmarks/view/index_messages']);

$page->base = '../../';
$page->title = 'Delete Bookmark?';
$page->finish(
    Tab::create(
        Tab::item('Bookmarks', '../')
        .Tab::activeItem("Bookmark #$id"),
        Page::text('Are you sure you want to delete the bookmark?')
        .Page::HR
        .Page::imageLink(
            'Yes, delete bookmark',
            "submit.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
