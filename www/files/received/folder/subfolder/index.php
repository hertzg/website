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

    if ($subfolders) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        foreach ($subfolders as $subfolder) {
            $folder_id = $subfolder->id;
            $items[] = Page\imageArrowLink(htmlspecialchars($subfolder->name),
                "?id=$folder_id", 'folder', ['id' => "folder_$folder_id"]);
        }
    }

    if ($files) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($files as $file) {
            $file_id = $file->id;
            $items[] = Page\imageArrowLinkWithDescription(
                htmlspecialchars($file->name), $file->readable_size,
                "file/?id=$file_id", "$file->media_type-file",
                ['id' => "file_$file_id"]);
        }
    }

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Folder is empty');
}

$title = "Received Folder #$id_received_folders";

include_once 'fns/create_location_bar.php';
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Received',
            'href' => "../../#folder_$id_received_folders",
        ],
    ],
    $title,
    create_location_bar($mysqli, $receivedFolderSubfolder)
    .join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, $title, $content, '../../../../');
