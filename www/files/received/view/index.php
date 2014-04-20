<?php

include_once '../fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

unset($_SESSION['files/received/messages']);

include_once '../../../fns/Page/imageLink.php';

$downloadLink = Page\imageLink('Download', "../download/?id=$id", 'download');

$href = "submit-import.php?id=$id";
$importLink = Page\imageLink('Import', $href, 'import-file');

$title = 'Rename and Import';
$href = "../rename-and-import/?id=$id";
$renameAndImportLink = Page\imageLink($title, $href, 'import-file');

$deleteLink = Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin');

include_once 'fns/create_preview.php';
include_once '../../../fns/bytestr.php';
include_once '../../../fns/create_panel.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/date_ago.php';
include_once '../../../fns/Page/infoText.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/twoColumns.php';
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
        .Form\label('Preview', create_preview($receivedFile))
        .'<div class="hr"></div>'
        .Page\infoText('File received '.date_ago($receivedFile->insert_time).'.')
    )
    .create_panel(
        'Options',
        Page\twoColumns($downloadLink, $importLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($renameAndImportLink, $deleteLink)
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received File #$id", $content, '../../../', [
    'head' => '<link rel="stylesheet" type="text/css" href="index.css?1" />',
]);
