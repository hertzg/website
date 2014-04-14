<?php

include_once 'fns/require_received_notes.php';
$user = require_received_notes();

unset(
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages']
);

include_once '../../fns/ReceivedNotes/indexOnReceiver.php';
include_once '../../lib/mysqli.php';
$receivedNotes = ReceivedNotes\indexOnReceiver($mysqli, $user->id_users);

include_once '../../fns/Page/imageArrowLink.php';

$items = [];
$icon = 'note';
foreach ($receivedNotes as $receivedNote) {
    $href = "view/?id=$receivedNote->id";
    $title = htmlspecialchars($receivedNote->text);
    $items[] = Page\imageArrowLink($title, $href, $icon);
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
            'title' => 'Notes',
            'href' => '..',
        ],
    ],
    'Received',
    Page\sessionMessages('notes/received/messages')
    .join('<div class="hr"></div>', $items)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Notes', $content, '../../');
