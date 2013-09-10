<?php

include_once 'lib/require-bookmark.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$page->base = '../';
$page->title = 'Delete Bookmark: '.htmlspecialchars(mb_substr($bookmark->title, 0, 20, 'UTF-8'));
$page->finish(
    Tab::create(
        Tab::item('Home', '../home.php')
        .Tab::item('Bookmarks', 'index.php')
        .Tab::activeItem('View')
    )
    .Page::text('Are you sure you want to delete the bookmark?')
    .Page::HR
    .Page::imageLink('Yes, delete bookmark', "submit-delete.php?id=$id", 'yes')
    .Page::HR
    .Page::imageLink('No, return back', "view.php?id=$id", 'no')
);
