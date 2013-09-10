<?php

include_once 'lib/require-bookmark.php';
include_once '../fns/create_external_url.php';
include_once '../fns/date_ago.php';
include_once '../fns/ifset.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

unset(
    $_SESSION['bookmarks/edit_errors'],
    $_SESSION['bookmarks/edit_lastpost'],
    $_SESSION['bookmarks/index_messages']
);

$title = $bookmark->title;
$url = $bookmark->url;

$base = '../';

$page->base = $base;
$page->title = htmlspecialchars(mb_substr($title ? $title : $url, 0, 20, 'UTF-8'));
$page->finish(
    Tab::create(
        Tab::item('Home', '../home.php')
        .Tab::item('Bookmarks', 'index.php')
        .Tab::activeItem('View')
    )
    .Page::messages(ifset($_SESSION['bookmarks/view_messages']))
    .($title ? Page::text(htmlspecialchars($title)).Page::HR : '')
    .Page::text('<a class="a" href="'.htmlspecialchars(create_external_url($url, $base)).'">'.htmlspecialchars($url).'</a>')
    .Page::HR
    .Page::text(
        '<div>Bookmark created '.date_ago($bookmark->inserttime).'.</div>'
        .($bookmark->inserttime != $bookmark->updatetime ? '<div>Last modified '.date_ago($bookmark->updatetime).'.</div>' : '')
    )
    .Tab::create(
        Tab::activeItem('Options')
    )
    .Page::imageLink('Edit Bookmark', "edit.php?id=$id", 'edit-bookmark')
    .Page::HR
    .Page::imageLink('Delete Bookmark', "delete.php?id=$id", 'trash-bin')
);
