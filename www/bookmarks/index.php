<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../lib/mysqli.php';
include_once '../lib/page.php';

include_once '../fns/request_strings.php';
list($tag) = request_strings('tag');

if ($tag === '') {

    include_once '../fns/Bookmarks/index.php';
    $bookmarks = Bookmarks\index($mysqli, $idusers);

    if (count($bookmarks) > 1) {

        include_once '../fns/BookmarkTags/indexOnUser.php';
        $bookmarkTags = BookmarkTags\indexOnUser($mysqli, $idusers);

        if ($bookmarkTags) {
            include_once '../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($bookmarkTags, array());
        } else {
            $filterMessage = '';
        }

    } else {
        $filterMessage = '';
    }

} else {

    include_once '../fns/BookmarkTags/indexOnTagName.php';
    $bookmarks = BookmarkTags\indexOnTagName($mysqli, $idusers, $tag);

    include_once '../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, './');

}

$items = array();
if ($bookmarks) {
    foreach ($bookmarks as $bookmark) {
        $href = "view/?id=$bookmark->idbookmarks";
        $escapedUrl = htmlspecialchars($bookmark->url);
        $title = $bookmark->title;
        if ($title === '') {
            $items[] = Page::imageLink($bookmark->url, $href, 'bookmark');
        } else {
            $items[] = Page::imageLinkWithDescription($title,
                $escapedUrl, $href, 'bookmark');
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
    $_SESSION['bookmarks/view/index_messages'],
    $_SESSION['home/index_messages']
);

$options = array(Page::imageLink('New Bookmark', 'new/', 'create-bookmark'));
if ($bookmarks) {
    $options[] = Page::imageLink(
        'Delete All Bookmarks',
        'delete-all/',
        'trash-bin'
    );
}

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Bookmarks';
$page->finish(
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '..',
            ],
        ],
        'Bookmarks',
        $pageMessages.$filterMessage.join(Page::HR, $items)
    )
    .create_panel('Options', join(Page::HR, $options))
);
