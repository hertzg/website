<?php

include_once 'lib/require-bookmark.php';
include_once '../fns/create_external_url.php';
include_once '../fns/create_panel.php';
include_once '../fns/date_ago.php';
include_once '../fns/ifset.php';
include_once '../classes/BookmarkTags.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

unset(
    $_SESSION['bookmarks/edit_errors'],
    $_SESSION['bookmarks/edit_lastpost'],
    $_SESSION['bookmarks/index_messages']
);

$title = $bookmark->title;
$url = $bookmark->url;
$inserttime = $bookmark->inserttime;
$updatetime = $bookmark->updatetime;

$taskTags = BookmarkTags::indexOnBookmark($id);
$tags = array();
foreach ($taskTags as $taskTag) {
    $escapedTag = htmlspecialchars($taskTag->tagname);
    $tags[] =
        "<a class=\"tag\" href=\"./?tag=$escapedTag\">"
            .$escapedTag
        .'</a>';
}
$tags = join(' ', $tags);

$base = '../';

$page->base = $base;
$page->title = htmlspecialchars(mb_substr($title ? $title : $url, 0, 20, 'UTF-8'));
$page->finish(
    Tab::create(
        Tab::item('Bookmarks', './')
        .Tab::activeItem('View'),
        Page::messages(ifset($_SESSION['bookmarks/view_messages']))
        .($title ? Page::text(htmlspecialchars($title)).Page::HR : '')
        .Page::text('<a class="a" href="'.htmlspecialchars(create_external_url($url, $base)).'">'.htmlspecialchars($url).'</a>')
        .Page::HR
        .($tags ? "<div class=\"page-text tags\"><span class=\"tags-label\">Tags:</span>$tags</div>".Page::HR : '')
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
