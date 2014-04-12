<?php

include_once '../fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

include_once '../../../fns/bytestr.php';
include_once '../../../fns/create_panel.php';
include_once '../../../fns/create_tabs.php';
include_once '../../../fns/date_ago.php';
include_once '../../../fns/Form/label.php';
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
    "Received File #$id",
    Form\label('Received from', htmlspecialchars($receivedFile->sender_username))
    .create_panel(
        'The File',
        Form\label('File name', htmlspecialchars($receivedFile->file_name))
        .'<div class="hr"></div>'
        .Form\label('Size', bytestr($receivedFile->file_size))
        .'<div class="hr"></div>'
        .Page\text('File received '.date_ago($receivedFile->insert_time).'.')
    )
    .create_panel(
        'Options',
        Page\imageLink('Import', "submit-import.php?id=$id", 'import-file')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received File #$id", $content, '../../../');
