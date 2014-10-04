<?php

include_once '../../fns/require_received_folder_file.php';
include_once '../../../../../lib/mysqli.php';
$values = require_received_folder_file($mysqli, '../');
list($receivedFolderFile, $id, $user) = $values;

$base = '../../../../../';
$fnsDir = '../../../../../fns';

if (!$receivedFolderFile->parent_id) {
    include_once "$fnsDir/redirect.php";
    redirect("../../file/?id=$id");
}

$title = "Received Folder #$receivedFolderFile->id_received_folders";
$name = $receivedFolderFile->name;

include_once "$fnsDir/Page/imageLink.php";
$namePart = urlencode(str_replace('/', '_', $name));
$href = "../../download-file/$id/$namePart";
$downloadLink = Page\imageLink('Download', $href, 'download');

include_once "$fnsDir/Page/filePreview.php";
$filePreview = Page\filePreview($receivedFolderFile->media_type,
    $receivedFolderFile->content_type, $id, '../../download-file/', $base);

include_once "fns/create_location_bar.php";
include_once "$fnsDir/bytestr.php";
include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Received',
            'href' => '../../..',
        ],
    ],
    $title,
    create_location_bar($mysqli, $receivedFolderFile)
    .Form\label('File name', htmlspecialchars($name))
    .'<div class="hr"></div>'
    .Form\label('Size', bytestr($receivedFolderFile->size))
    .'<div class="hr"></div>'
    .Form\label('Preview', $filePreview)
    .create_panel('File Options', $downloadLink)
);

include_once "$fnsDir/echo_page.php";
echo_page($user, $title, $content, $base);
