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

include_once "$fnsDir/ReceivedFolderFiles/indexOnFolder.php";
$files = ReceivedFolderFiles\indexOnFolder($mysqli, $id, 0);

include_once "$fnsDir/ReceivedFolderSubfolders/indexOnFolder.php";
$subfolders = ReceivedFolderSubfolders\indexOnFolder($mysqli, $id, 0);

$items = [];

if ($files || $subfolders) {

    foreach ($subfolders as $subfolder) {
        $title = htmlspecialchars($subfolder->name);
        $href = "subfolder/?id=$subfolder->id";
        $items[] = Page\imageLink($title, $href, 'folder');
    }

    foreach ($files as $file) {
        $title = htmlspecialchars($file->name);
        $items[] = Page\imageLink($title, "file/?id=$file->id", 'file');
    }

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Folder is empty');
}

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
    .create_panel('The Folder', join('<div class="hr"></div>', $items))
    .create_panel('Options', $deleteLink)
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Received Folder #$id", $content, '../../../');
