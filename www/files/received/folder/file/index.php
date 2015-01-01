<?php

include_once '../fns/require_received_folder_file.php';
include_once '../../../../lib/mysqli.php';
list($receivedFolderFile, $id, $user) = require_received_folder_file($mysqli);

$base = '../../../../';
$fnsDir = '../../../../fns';

if ($receivedFolderFile->parent_id) {
    include_once "$fnsDir/redirect.php";
    redirect("../subfolder/file/?id=$id");
}

$id_received_folders = $receivedFolderFile->id_received_folders;
$title = "Received Folder #$id_received_folders";
$name = $receivedFolderFile->name;

include_once "$fnsDir/Page/imageLink.php";
$namePart = rawurlencode(str_replace('/', '_', $name));
$href = "../download-file/$id/$namePart?0";
$downloadLink = Page\imageLink('Download', $href, 'download');

include_once "$fnsDir/Page/filePreview.php";
$filePreview = Page\filePreview($receivedFolderFile->media_type,
    $receivedFolderFile->content_type, $id, '../download-file/', $base);

include_once "$fnsDir/bytestr.php";
include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Received',
            'href' => "../../#folder_$id_received_folders",
        ],
    ],
    $title,
    '<div class="greyBar textAndButtons">'
        .'<span class="textAndButtons-text">Location:</span>'
        ."<a class=\"tag\" href=\"../?id=$id_received_folders#file_$id\">root</a>"
    .'</div>'
    .Form\label('File name', htmlspecialchars($name))
    .'<div class="hr"></div>'
    .Form\label('Size', bytestr($receivedFolderFile->size))
    .'<div class="hr"></div>'
    .Form\label('Preview', $filePreview)
    .create_panel('File Options', $downloadLink)
);

include_once "$fnsDir/echo_page.php";
echo_page($user, $title, $content, $base);
