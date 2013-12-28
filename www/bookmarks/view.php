<?php

include_once 'lib/require-bookmark.php';
include_once '../fns/create_external_url.php';
include_once '../fns/create_panel.php';
include_once '../fns/create_tags.php';
include_once '../fns/date_ago.php';
include_once '../classes/BookmarkTags.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

if (array_key_exists('bookmarks/view_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['bookmarks/view_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['bookmarks/edit_errors'],
    $_SESSION['bookmarks/edit_lastpost'],
    $_SESSION['bookmarks/index_messages']
);

$title = $bookmark->title;
$url = $bookmark->url;
$inserttime = $bookmark->inserttime;
$updatetime = $bookmark->updatetime;

$base = '../';

$page->base = $base;
$page->title = htmlspecialchars(mb_substr($title ? $title : $url, 0, 20, 'UTF-8'));
$page->finish(
    Tab::create(
        Tab::item('Bookmarks', './')
        .Tab::activeItem('View'),
        $pageMessages
        .($title ? Page::text(htmlspecialchars($title)).Page::HR : '')
        .Page::text('<a class="a" href="'.htmlspecialchars(create_external_url($url, $base)).'">'.htmlspecialchars($url).'</a>')
        .create_tags(BookmarkTags::indexOnBookmark($id))
        .Page::HR
        .Page::text(
            '<div>Bookmark created '.date_ago($inserttime).'.</div>'
            .($inserttime != $updatetime ? '<div>Last modified '.date_ago($updatetime).'.</div>' : '')
        )
    )
    .create_panel(
        'Options',
        Page::imageLink('Edit Bookmark', "edit.php?id=$id", 'edit-bookmark')
        .Page::HR
        .Page::imageLink('Delete Bookmark', "delete.php?id=$id", 'trash-bin')
    )
);
