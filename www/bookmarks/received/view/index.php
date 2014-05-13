<?php

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli);

unset(
    $_SESSION['bookmarks/received/edit-and-import/errors'],
    $_SESSION['bookmarks/received/edit-and-import/values'],
    $_SESSION['bookmarks/received/messages']
);

$items = [];

include_once '../../../fns/Page/text.php';

$title = $receivedBookmark->title;
if ($title !== '') {
    $items[] = Page\text(htmlspecialchars($title));
}

$items[] = Page\text(htmlspecialchars($receivedBookmark->url));

$tags = $receivedBookmark->tags;
if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

include_once '../../../fns/date_ago.php';
$text = 'Bookmark received '.date_ago($receivedBookmark->insert_time).'.';
include_once '../../../fns/Page/infoText.php';
$infoText = Page\infoText($text);

include_once 'fns/create_options_panel.php';
include_once '../../../fns/create_panel.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Form/label.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Received',
            'href' => '..',
        ],
    ],
    "Received Bookmark #$id",
    Form\label('Received from', htmlspecialchars($receivedBookmark->sender_username))
    .create_panel('The Bookmark', join('<div class="hr"></div>', $items))
    .$infoText
    .create_options_panel($receivedBookmark)
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received Bookmark #$id", $content, '../../../');
