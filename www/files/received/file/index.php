<?php

include_once 'fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

unset(
    $_SESSION['files/received/file/rename-and-import/errors'],
    $_SESSION['files/received/file/rename-and-import/values'],
    $_SESSION['files/received/messages']
);

$queryString = "?id=$id";
$fnsDir = '../../../fns';
$name = $receivedFile->name;

include_once "$fnsDir/Page/imageLink.php";
$namePart = rawurlencode(str_replace('/', '_', $name));
$href = "download/$id/$namePart";
$downloadLink = Page\imageLink('Download', $href, 'download');

$href = "submit-import.php$queryString";
$importLink = Page\imageLink('Import', $href, 'import-file');

include_once "$fnsDir/Page/imageArrowLink.php";
$title = 'Rename and Import';
$href = "rename-and-import/$queryString";
$renameAndImportLink = Page\imageArrowLink($title, $href, 'import-file');

if ($receivedFile->archived) {
    $href = "submit-unarchive.php$queryString";
    $archiveLink = Page\imageLink('Unarchive', $href, 'unarchive');
} else {
    $href = "submit-archive.php$queryString";
    $archiveLink = Page\imageLink('Archive', $href, 'archive');
}

$href = "delete/$queryString";
$deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

include_once "$fnsDir/Page/filePreview.php";
$filePreview = Page\filePreview($receivedFile->media_type,
    $receivedFile->content_type, $id, 'download/');

include_once "$fnsDir/bytestr.php";
include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/date_ago.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/infoText.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/staticTwoColumns.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/twoColumns.php";
$content = Page\tabs(
    [
        [
            'title' => 'Received',
            'href' => '..',
        ],
    ],
    "Received File #$id",
    Page\sessionMessages('files/received/file/messages')
    .Form\label('Received from',
        htmlspecialchars($receivedFile->sender_username))
    .create_panel(
        'The File',
        Form\label('File name', htmlspecialchars($name))
        .'<div class="hr"></div>'
        .Form\label('Size', bytestr($receivedFile->size))
        .'<div class="hr"></div>'
        .Form\label('Preview', $filePreview)
        .Page\infoText(
            'File received '.date_ago($receivedFile->insert_time).'.')
    )
    .create_panel(
        'File Options',
        Page\staticTwoColumns($downloadLink, $importLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($renameAndImportLink, $archiveLink)
        .'<div class="hr"></div>'
        .$deleteLink
    )
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Received File #$id", $content, '../../../');
