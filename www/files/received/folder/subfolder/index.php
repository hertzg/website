<?php

include_once 'fns/require_received_folder_subfolder.php';
include_once '../../../../lib/mysqli.php';
$values = require_received_folder_subfolder($mysqli);
list($receivedFolderSubfolder, $id, $user) = $values;

unset($_SESSION['files/received/folder/messages']);

$fnsDir = '../../../../fns';
$id_received_folders = $receivedFolderSubfolder->id_received_folders;

$items = [];

include_once "$fnsDir/ReceivedFolderSubfolders/indexOnParent.php";
$subfolders = ReceivedFolderSubfolders\indexOnParent(
    $mysqli, $id_received_folders, $id);

include_once "$fnsDir/ReceivedFolderFiles/indexOnParent.php";
$files = ReceivedFolderFiles\indexOnParent($mysqli, $id_received_folders, $id);

if ($subfolders || $files) {

    include_once "$fnsDir/Page/imageLink.php";

    foreach ($subfolders as $subfolder) {
        $title = htmlspecialchars($subfolder->name);
        $href = "?id=$subfolder->id";
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

$title = "Received Folder #$id_received_folders";

include_once 'fns/create_location_bar.php';
include_once "$fnsDir/bytestr.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Received',
            'href' => '../..',
        ],
    ],
    $title,
    create_location_bar($mysqli, $receivedFolderSubfolder)
    .join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/echo_page.php";
echo_page($user, $title, $content, '../../../../');
