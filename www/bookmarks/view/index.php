<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id) = require_bookmark($mysqli);

include_once '../../lib/page.php';

if (array_key_exists('bookmarks/view/index_messages', $_SESSION)) {
    include_once '../../fns/Page/messages.php';
    $pageMessages = Page\messages($_SESSION['bookmarks/view/index_messages']);
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

include_once '../../fns/BookmarkTags/indexOnBookmark.php';
$tags = BookmarkTags\indexOnBookmark($mysqli, $id);

$base = '../../';

include_once '../../fns/create_external_url.php';
$externalUrl = create_external_url($url, $base);

include_once '../../fns/date_ago.php';
$infoText = '<div>Bookmark created '.date_ago($inserttime).'.</div>';
if ($inserttime != $updatetime) {
    $infoText .= '<div>Last modified '.date_ago($updatetime).'.</div>';
}

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/create_tags.php';

$page->base = $base;
$page->title = "Bookmark #$id";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Bookmarks',
                'href' => '..',
            ),
        ),
        "Bookmark #$id",
        $pageMessages
        .($title === '' ? '' : Page::text(htmlspecialchars($title)).Page::HR)
        .Page::text(htmlspecialchars($url))
        .create_tags('../', $tags)
        .Page::HR
        .Page::text($infoText)
    )
    .create_panel(
        'Options',
        Page::imageLink('Open', $externalUrl, 'run')
        .Page::HR
        .Page::imageLink('Open in New Tab', $externalUrl, 'run', array(
            'target' => '_blank',
        ))
        .Page::HR
        .Page::imageArrowLink('Edit Bookmark', "../edit/?id=$id", 'edit-bookmark')
        .Page::HR
        .Page::imageArrowLink('Delete Bookmark', "../delete/?id=$id", 'trash-bin')
    )
);
