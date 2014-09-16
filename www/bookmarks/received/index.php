<?php

include_once 'fns/require_received_bookmarks.php';
$user = require_received_bookmarks();
$id_users = $user->id_users;

include_once '../../fns/Users/Bookmarks/Received/clearNumberNew.php';
include_once '../../lib/mysqli.php';
Users\Bookmarks\Received\clearNumberNew($mysqli, $id_users);

unset(
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages'],
    $_SESSION['bookmarks/received/view/messages']
);

include_once '../../fns/request_strings.php';
list($all) = request_strings('all');

if ($all) {
    include_once '../../fns/ReceivedBookmarks/indexOnReceiver.php';
    $receivedBookmarks = ReceivedBookmarks\indexOnReceiver($mysqli, $id_users);
} else {
    include_once '../../fns/ReceivedBookmarks/indexNotArchivedOnReceiver.php';
    $receivedBookmarks = ReceivedBookmarks\indexNotArchivedOnReceiver(
        $mysqli, $id_users);
}

include_once '../../fns/create_sender_description.php';
include_once '../../fns/Page/imageArrowLinkWithDescription.php';

$items = [];

if ($receivedBookmarks) {
    foreach ($receivedBookmarks as $receivedBookmark) {

        $title = $receivedBookmark->title;
        if ($title === '') $title = $receivedBookmark->url;
        $title = htmlspecialchars($title);

        $description = create_sender_description($receivedBookmark);
        $href = "view/?id=$receivedBookmark->id";
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'bookmark');

    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No received bookmarks');
}

if (!$all && $user->num_archived_received_bookmarks) {
    include_once '../../fns/Page/buttonLink.php';
    $items[] = Page\buttonLink('Show Archived Bookmarks', '?all=1');
}

include_once '../../fns/Page/imageArrowLink.php';
$title = 'Delete All Bookmarks';
$deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

include_once '../../fns/create_new_item_button.php';
include_once '../../fns/create_panel.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
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
    .create_panel('Options', $deleteAllLink),
    create_new_item_button('Bookmark', '../')
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Bookmarks', $content, '../../');
