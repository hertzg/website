<?php

include_once 'fns/require_received_folder.php';
include_once '../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli);

unset($_SESSION['files/received/messages']);

$queryString = "?id=$id";
$fnsDir = '../../../fns';

include_once "$fnsDir/Page/imageLink.php";

$href = "delete/$queryString";
$deleteLink = Page\imageLink('Delete', $href, 'trash-bin');

include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
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
    "Received Folder #$id",
    Page\sessionMessages('files/received/folder/messages')
    .Form\label('Received from',
        htmlspecialchars($receivedFolder->sender_username))
    .'<div class="hr"></div>'
    .Form\label('Folder name',
        htmlspecialchars($receivedFolder->name))
    .create_panel(
        'Options',
        $deleteLink
    )
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Received Folder #$id", $content, '../../../');
