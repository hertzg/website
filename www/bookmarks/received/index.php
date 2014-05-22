<?php

include_once 'fns/require_received_bookmarks.php';
$user = require_received_bookmarks();

unset(
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages']
);

include_once '../../fns/ReceivedBookmarks/indexOnReceiver.php';
include_once '../../lib/mysqli.php';
$receivedBookmarks = ReceivedBookmarks\indexOnReceiver(
    $mysqli, $user->id_users);

include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageArrowLinkWithDescription.php';

$items = [];
$icon = 'bookmark';
foreach ($receivedBookmarks as $receivedBookmark) {
    $href = "view/?id=$receivedBookmark->id";
    $description = htmlspecialchars($receivedBookmark->url);
    $title = $receivedBookmark->title;
    if ($title === '') {
        $items[] = Page\imageArrowLink($description, $href, $icon);
    } else {
        $title = htmlspecialchars($title);
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    }
}

$title = 'Delete All Bookmarks';
$deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content = Page\tabs(
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
    'Received',
    Page\sessionMessages('bookmarks/received/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', $deleteAllLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Bookmarks', $content, '../../');
