<?php

include_once '../fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

unset($_SESSION['files/received/messages']);

$queryString = "?id=$id";

include_once '../../../fns/Page/imageLink.php';

$href = "../download/$queryString";
$downloadLink = Page\imageLink('Download', $href, 'download');

$href = "submit-import.php$queryString";
$importLink = Page\imageLink('Import', $href, 'import-file');

$title = 'Rename and Import';
$href = "../rename-and-import/$queryString";
$renameAndImportLink = Page\imageLink($title, $href, 'import-file');

if ($receivedFile->archived) {
    $archiveLink = Page\imageLink('Unarchive',
        "submit-unarchive.php$queryString", 'TODO');
} else {
    $archiveLink = Page\imageLink('Archive',
        "submit-archive.php$queryString", 'TODO');
}

$deleteLink = Page\imageLink('Delete', "../delete/$queryString", 'trash-bin');

include_once 'fns/create_preview.php';
include_once '../../../fns/bytestr.php';
include_once '../../../fns/create_panel.php';
include_once '../../../fns/date_ago.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/infoText.php';
include_once '../../../fns/Page/sessionMessages.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
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
    Page\sessionMessages('files/received/view/messages')
    .Form\label('Received from',
        htmlspecialchars($receivedFile->sender_username))
    .create_panel(
        'The File',
        Form\label('File name', htmlspecialchars($receivedFile->name))
        .'<div class="hr"></div>'
        .Form\label('Size', bytestr($receivedFile->size))
        .'<div class="hr"></div>'
        .Form\label('Preview', create_preview($receivedFile))
        .Page\infoText(
            'File received '.date_ago($receivedFile->insert_time).'.')
    )
    .create_panel(
        'Options',
        Page\twoColumns($downloadLink, $importLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($renameAndImportLink, $archiveLink)
        .'<div class="hr"></div>'
        .$deleteLink
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Received File #$id", $content, '../../../', [
    'head' => '<link rel="stylesheet" type="text/css" href="index.css?1" />',
]);
