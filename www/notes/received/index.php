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

include_once '../../fns/Page/imageArrowLink.php';

$items = [];
foreach ($receivedNotes as $receivedNote) {

    $text = $receivedNote->text;
    if ($receivedNote->encrypt) {
        include_once '../../fns/encrypt_text.php';
        $text = encrypt_text($text);
        $icon = 'encrypted-note';
    } else {
        $icon = 'note';
    }

    $href = "view/?id=$receivedNote->id";
    $title = htmlspecialchars($text);
    $items[] = Page\imageArrowLink($title, $href, $icon);

}
if (!$all && $user->num_archived_received_notes) {
    include_once '../../fns/Form/button.php';
    $items[] =
        '<form action="./">'
            .Form\button('Show Archived Notes')
            .'<input type="hidden" name="all" value="1" />'
        .'</form>';
}

$title = 'Delete All Notes';
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
            'title' => 'Notes',
            'href' => '..',
        ],
    ],
    'Received',
    Page\sessionMessages('notes/received/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel('Options', $deleteAllLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Received Notes', $content, '../../');
