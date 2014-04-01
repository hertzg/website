<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset(
    $_SESSION['bookmarks/edit/errors'],
    $_SESSION['bookmarks/edit/values'],
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages'],
    $_SESSION['bookmarks/send/errors'],
    $_SESSION['bookmarks/send/values']
);

$url = $bookmark->url;

$base = '../../';

if (parse_url($url, PHP_URL_SCHEME) === null) {
    $parsedUrl = "http://$url";
} else {
    $parsedUrl = $url;
}
include_once '../../fns/create_external_url.php';
$externalUrl = create_external_url($parsedUrl, $base);

$items = [];

include_once '../../fns/Page/text.php';

$title = $bookmark->title;
if ($title !== '') {
    $items[] = Page\text(htmlspecialchars($title));
}

$items[] = Page\text(htmlspecialchars($url));

include_once '../../fns/BookmarkTags/indexOnBookmark.php';
$tags = BookmarkTags\indexOnBookmark($mysqli, $id);
if ($tags) {
    include_once '../../fns/create_tags.php';
    $items[] = create_tags('../', $tags);
}

$insert_time = $bookmark->insert_time;
$update_time = $bookmark->update_time;
include_once '../../fns/date_ago.php';
$text = '<div>Bookmark created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $text .= '<div>Last modified '.date_ago($update_time).'.</div>';
}
$items[] = Page\text($text);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ],
            [
                'title' => 'Bookmarks',
                'href' => '..',
            ],
        ],
        "Bookmark #$id",
        Page\sessionMessages('bookmarks/view/messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_panel(
        'Options',
        Page\imageLink('Open', $externalUrl, 'run')
        .'<div class="hr"></div>'
        .Page\imageLink('Open in New Tab', $externalUrl, 'run', [
            'target' => '_blank',
        ])
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Edit Bookmark', "../edit/?id=$id", 'edit-bookmark')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Send Bookmark', "../send/?id=$id", 'send')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Delete Bookmark', "../delete/?id=$id", 'trash-bin')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Bookmark #$id", $content, $base);
