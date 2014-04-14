<?php

include_once '../fns/require_received_notes.php';
$user = require_received_notes('../');

unset($_SESSION['notes/received/messages']);

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../../home/',
        ],
        [
            'title' => 'Notes',
            'href' => '../..',
        ],
    ],
    'Received',
    Page\text('Are you sure you want to delete all the received notes?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete all notes', 'submit.php', 'yes'),
        Page\imageLink('No, return back', '..', 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete All Received Notes', $content, '../../../');
