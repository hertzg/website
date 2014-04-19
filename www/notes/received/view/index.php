<?php

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);

unset(
    $_SESSION['notes/received/edit-and-import/errors'],
    $_SESSION['notes/received/edit-and-import/values'],
    $_SESSION['notes/received/messages']
);

include_once '../../../fns/Page/text.php';
$items = [Page\text(htmlspecialchars($receivedNote->text))];

$tags = $receivedNote->tags;
if ($tags !== '') {
    $items[] = Page\text('Tags: '.htmlspecialchars($tags));
}

include_once '../../../fns/date_ago.php';
include_once '../../../fns/Page/infoText.php';
$items[] = Page\infoText('Note received '.date_ago($receivedNote->insert_time).'.');

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
    "Received Note #$id",
    Form\label('Received from', htmlspecialchars($receivedNote->sender_username))
    .create_panel('The Note', join('<div class="hr"></div>', $items))
    .create_options_panel($id)
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received Note #$id", $content, '../../../');
