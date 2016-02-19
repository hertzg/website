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

include_once "$fnsDir/ReceivedFolderFiles/ensureSums.php";
ReceivedFolderFiles\ensureSums($mysqli, $receivedFolderFile);

$id_received_folders = $receivedFolderFile->id_received_folders;
$title = "Received Folder #$id_received_folders";
$name = $receivedFolderFile->name;

include_once "$fnsDir/FileName/rawurlencode.php";
$namePart = FileName\rawurlencode($name);

include_once "$fnsDir/Page/imageLink.php";
$downloadLink = Page\imageLink('Download',
    "../../download-file/$id/$namePart", 'download');

include_once "$fnsDir/ReceivedFolderFiles/File/path.php";
$path = ReceivedFolderFiles\File\path($receivedFolderFile->id_users, $id);

include_once "$fnsDir/Page/filePreview.php";
$filePreview = Page\filePreview($receivedFolderFile->media_type,
    $receivedFolderFile->content_type, $id, $path,
    '../../download-file/', $base, $scripts);

include_once "fns/create_location_bar.php";
include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/create.php";
$content =
    Page\create(
        [
            'title' => 'Files',
            'href' => "../../../#folder_$id_received_folders",
        ],
        $title,
        create_location_bar($mysqli, $receivedFolderFile)
        .Form\label('File name', htmlspecialchars($name))
        .'<div class="hr"></div>'
        .Form\label('Size', $receivedFolderFile->readable_size)
        .'<div class="hr"></div>'
        .Form\label('Preview', $filePreview)
        .'<div class="hr"></div>'
        .Form\label('MD5 sum', $receivedFolderFile->md5_sum)
        .'<div class="hr"></div>'
        .Form\label('SHA-256 sum', $receivedFolderFile->sha256_sum)
    )
    .create_panel('File Options', $downloadLink);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, $title, $content, $base, ['scripts' => $scripts]);
