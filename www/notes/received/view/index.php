<?php

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);

unset(
    $_SESSION['notes/received/edit-and-import/errors'],
    $_SESSION['notes/received/edit-and-import/values'],
    $_SESSION['notes/received/messages']
);

$base = '../../../';

include_once '../../../fns/render_external_links.php';
include_once '../../../fns/Page/text.php';
$items = [
    Page\text(
        nl2br(
            render_external_links(htmlspecialchars($receivedNote->text), $base)
        )
    )
];

$tags = $receivedNote->tags;
if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

include_once '../../../fns/date_ago.php';
$text = 'Note received '.date_ago($receivedNote->insert_time).'.';
include_once '../../../fns/Page/infoText.php';
$infoText = Page\infoText($text);

include_once 'fns/create_options_panel.php';
include_once '../../../fns/create_panel.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/sessionMessages.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Received',
            'href' => '..',
        ],
    ],
    "Received Note #$id",
    Page\sessionMessages('notes/received/view/messages')
    .Form\label('Received from',
        htmlspecialchars($receivedNote->sender_username))
    .create_panel('The Note', join('<div class="hr"></div>', $items))
    .$infoText
    .create_options_panel($receivedNote)
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received Note #$id", $content, $base);
