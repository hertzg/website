<?php

include_once 'fns/require_received_notes.php';
$user = require_received_notes();
$id_users = $user->id_users;

include_once '../../fns/Users/Notes/Received/clearNumberNew.php';
include_once '../../lib/mysqli.php';
Users\Notes\Received\clearNumberNew($mysqli, $id_users);

unset(
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages'],
    $_SESSION['notes/received/view/messages']
);

include_once '../../fns/request_strings.php';
list($all) = request_strings('all');

if ($all) {
    include_once '../../fns/ReceivedNotes/indexOnReceiver.php';
    $receivedNotes = ReceivedNotes\indexOnReceiver($mysqli, $id_users);
} else {
    include_once '../../fns/ReceivedNotes/indexNotArchivedOnReceiver.php';
    $receivedNotes = ReceivedNotes\indexNotArchivedOnReceiver(
        $mysqli, $id_users);
}

include_once '../../fns/create_sender_description.php';
include_once '../../fns/Page/imageArrowLinkWithDescription.php';

$items = [];

if ($receivedNotes) {
    foreach ($receivedNotes as $receivedNote) {

        $text = $receivedNote->text;
        if ($receivedNote->encrypt) {
            include_once '../../fns/encrypt_text.php';
            $text = encrypt_text($text);
            $icon = 'encrypted-note';
        } else {
            $icon = 'note';
        }

        $title = htmlspecialchars($text);
        $description = create_sender_description($receivedNote);
        $href = "view/?id=$receivedNote->id";
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);

    }
} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No received notes');
}

if (!$all && $user->num_archived_received_notes) {
    include_once '../../fns/Page/buttonLink.php';
    $items[] = Page\buttonLink('Show Archived Notes', '?all=1');
}

include_once '../../fns/Page/imageArrowLink.php';
$title = 'Delete All Notes';
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
            'title' => 'Notes',
            'href' => '..',
        ],
    ],
    'Received',
    Page\sessionMessages('notes/received/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', $deleteAllLink),
    create_new_item_button('Note', '../')
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Notes', $content, '../../');
