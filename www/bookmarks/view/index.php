<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id) = require_bookmark($mysqli);

include_once '../../lib/page.php';

include_once '../../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('bookmarks/view/index_messages');

unset(
    $_SESSION['bookmarks/edit/index_errors'],
    $_SESSION['bookmarks/edit/index_lastpost'],
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

include_once '../../fns/Page/text.php';

if ($title === '') {
    $titleItem = '';
} else {
    $titleItem = Page\text(htmlspecialchars($title)).Page::HR;
}

$urlItem = Page\text(htmlspecialchars($url));

include_once '../../fns/date_ago.php';
$datesText = '<div>Bookmark created '.date_ago($inserttime).'.</div>';
if ($inserttime != $updatetime) {
    $datesText .= '<div>Last modified '.date_ago($updatetime).'.</div>';
}
$datesText = Page\text($datesText);

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
        $pageMessages.$titleItem.$urlItem
        .create_tags('../', $tags).Page::HR.$datesText
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
