<?php

include_once 'fns/require_received_folder.php';
include_once '../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli);

unset(
    $_SESSION['files/received/messages'],
    $_SESSION['files/received/folder/rename-and-import/errors'],
    $_SESSION['files/received/folder/rename-and-import/values']
);

$fnsDir = '../../../fns';

include_once "$fnsDir/ReceivedFolderFiles/indexOnParent.php";
$files = ReceivedFolderFiles\indexOnParent($mysqli, $id, 0);

include_once "$fnsDir/ReceivedFolderSubfolders/indexOnParent.php";
$subfolders = ReceivedFolderSubfolders\indexOnParent($mysqli, $id, 0);

$items = [];

if ($files || $subfolders) {

    include_once "$fnsDir/Page/imageLink.php";

    foreach ($subfolders as $subfolder) {
        $title = htmlspecialchars($subfolder->name);
        $href = "subfolder/?id=$subfolder->id";
        $items[] = Page\imageLink($title, $href, 'folder');
    }

    foreach ($files as $file) {
        $title = htmlspecialchars($file->name);
        $icon = "$file->media_type-file";
        $items[] = Page\imageLink($title, "file/?id=$file->id", $icon);
    }

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Folder is empty');
}

include_once 'fns/create_options_panel.php';
include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
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
    .Form\label('Folder name', htmlspecialchars($receivedFolder->name))
    .create_panel('The Folder', join('<div class="hr"></div>', $items))
    .create_options_panel($receivedFolder)
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Received Folder #$id", $content, '../../../');
