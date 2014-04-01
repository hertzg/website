<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

if (!$user->num_received_bookmarks) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

unset(
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages']
);

include_once '../../fns/ReceivedBookmarks/indexOnReceiver.php';
include_once '../../lib/mysqli.php';
$receivedBookmarks = ReceivedBookmarks\indexOnReceiver($mysqli, $user->id_users);

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
        $items[] = Page\imageArrowLinkWithDescription($title, $description, $href, $icon);
    }
}

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content = create_tabs(
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
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Bookmarks', $content, $base);
