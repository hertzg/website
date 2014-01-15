<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../fns/request_strings.php';
include_once '../classes/Bookmarks.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

list($tag) = request_strings('tag');

if ($tag === '') {
    $bookmarks = Bookmarks::index($idusers);
    if (count($bookmarks) > 1) {
        include_once '../classes/BookmarkTags.php';
        $bookmarkTags = BookmarkTags::indexOnUser($idusers);
        if ($bookmarkTags) {
            include_once '../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($bookmarkTags, array());
        }
    } else {
        $filterMessage = '';
    }
} else {
    $bookmarks = Bookmarks::indexOnTag($idusers, $tag);
    include_once '../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, './');
}

$items = array();
if ($bookmarks) {
    foreach ($bookmarks as $bookmark) {
        $href = "view.php?id=$bookmark->idbookmarks";
        $escapedUrl = htmlspecialchars($bookmark->url);
        if ($bookmark->title) {
            $items[] = Page::imageLinkWithDescription($bookmark->title, $escapedUrl, $href, 'bookmark');
        } else {
            $items[] = Page::imageLink($bookmark->url, $href, 'bookmark');
        }
    }
} else {
    $items[] = Page::info('No bookmarks.');
}

if (array_key_exists('bookmarks/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['bookmarks/index_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['bookmarks/new/index_errors'],
    $_SESSION['bookmarks/new/index_lastpost'],
    $_SESSION['bookmarks/view_messages'],
    $_SESSION['home/index_messages']
);

$options = array(Page::imageLink('New Bookmark', 'new/', 'create-bookmark'));
if ($bookmarks) {
    $options[] = Page::imageLink(
        'Delete All Bookmarks',
        'delete-all.php',
        'trash-bin'
    );
}

$page->base = '../';
$page->title = 'Bookmarks';
$page->finish(
    Tab::create(
        Tab::activeItem('Bookmarks'),
        $pageMessages
        .$filterMessage
        .join(Page::HR, $items)
    )
    .create_panel('Options', join(Page::HR, $options))
);
