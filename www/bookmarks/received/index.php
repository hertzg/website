<?php

include_once 'fns/require_received_bookmarks.php';
$user = require_received_bookmarks();
$id_users = $user->id_users;

unset(
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages'],
    $_SESSION['bookmarks/received/view/messages']
);

include_once '../../fns/request_strings.php';
list($all) = request_strings('all');

include_once '../../lib/mysqli.php';
if ($all) {
    include_once '../../fns/ReceivedBookmarks/indexOnReceiver.php';
    $receivedBookmarks = ReceivedBookmarks\indexOnReceiver($mysqli, $id_users);
} else {
    include_once '../../fns/ReceivedBookmarks/indexNotArchivedOnReceiver.php';
    $receivedBookmarks = ReceivedBookmarks\indexNotArchivedOnReceiver(
        $mysqli, $id_users);
}

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
if (!$all && $user->num_archived_received_bookmarks) {
    include_once '../../fns/Form/button.php';
    $items[] =
        '<form action="./">'
            .Form\button('Show Archived Bookmarks')
            .'<input type="hidden" name="all" value="1" />'
        .'</form>';
}

$title = 'Delete All Bookmarks';
$deleteAllLink = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

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
    .create_panel('Options', $deleteAllLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Bookmarks', $content, '../../');
