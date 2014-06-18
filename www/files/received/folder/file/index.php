<?php

include_once 'fns/require_received_folder_file.php';
include_once '../../../../lib/mysqli.php';
list($receivedFolderFile, $id, $user) = require_received_folder_file($mysqli);

$id_received_folders = $receivedFolderFile->id_received_folders;

$fnsDir = '../../../../fns';
$title = "Received Folder #$id_received_folders";

$parentHref = "../?id=$id_received_folders";

include_once "$fnsDir/bytestr.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../..',
        ],
        [
            'title' => 'Received',
            'href' => '../..',
        ],
    ],
    $title,
    Page\imageLink('.. Parent folder', $parentHref, 'parent-folder')
    .'<div class="hr"></div>'
    .Form\label('File name', htmlspecialchars($receivedFolderFile->name))
    .'<div class="hr"></div>'
    .Form\label('Size', bytestr($receivedFolderFile->size))
);

include_once "$fnsDir/echo_page.php";
echo_page($user, $title, $content, '../../../../');
