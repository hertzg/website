<?php

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
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
    Page\text('Are you sure you want to delete the note?')
    .'<div class="hr"></div>'
    .Page\imageLink('Yes, delete note', "submit.php?id=$id", 'yes')
    .'<div class="hr"></div>'
    .Page\imageLink('No, return back', "../view/?id=$id", 'no')
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete Received Note #?', $content, '../../../');
