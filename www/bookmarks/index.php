<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../classes/Bookmarks.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$bookmarks = '';
foreach (Bookmarks::index($idusers) as $i => $bookmark) {
    if ($i) $bookmarks .= Page::HR;
    $href = "view.php?id=$bookmark->idbookmarks";
    $escapedUrl = htmlspecialchars($bookmark->url);
    if ($bookmark->title) {
        $bookmarks .= Page::imageLinkWithDescription($bookmark->title, $escapedUrl, $href, 'bookmark');
    } else {
        $bookmarks .= Page::imageLink($bookmark->url, $href, 'bookmark');
    }
}
if (!$bookmarks) {
    $bookmarks .= Page::info('No bookmarks.');
}

unset(
    $_SESSION['bookmarks/add_errors'],
    $_SESSION['bookmarks/edit_errors'],
    $_SESSION['bookmarks/view_messages'],
    $_SESSION['home_messages']
);

$page->base = '../';
$page->title = 'Bookmarks';
$page->finish(
    Tab::create(
        Tab::activeItem('Bookmarks'),
        Page::messages(ifset($_SESSION['bookmarks/index_messages']))
        .$bookmarks
    )
    .create_panel(
        'Options',
        Page::imageLink('New Bookmark', 'add.php', 'create-bookmark')
    )
);
