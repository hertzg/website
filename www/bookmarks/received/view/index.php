<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

include_once '../../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../../../fns/ReceivedBookmarks/getOnReceiver.php';
include_once '../../../lib/mysqli.php';
$receivedBookmark = ReceivedBookmarks\getOnReceiver($mysqli, $user->id_users, $id);

if (!$receivedBookmark) {
    include_once '../../../fns/redirect.php';
    redirect('..');
}

$items = [];

include_once '../../../fns/Page/text.php';

$title = $receivedBookmark->title;
if ($title !== '') {
    $items[] = Page\text(htmlspecialchars($title));
}

$items[] = Page\text(htmlspecialchars($receivedBookmark->url));

$tags = $receivedBookmark->tags;
if ($tags !== '') {
    $items[] = Page\text('Tags: '.htmlspecialchars($tags));
}

include_once 'fns/create_options_panel.php';
include_once '../../../fns/create_panel.php';
include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/label.php';
$content = create_tabs(
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
    .create_options_panel($id)
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received Bookmark #$id", $content, $base);
