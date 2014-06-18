<?php

include_once '../fns/require_received_folder.php';
include_once '../../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli, '../');

unset($_SESSION['files/received/folder/messages']);

$fnsDir = '../../../../fns';

include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/Page/text.php";
include_once "$fnsDir/Page/twoColumns.php";
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
    "Received Folder #$id",
    Page\text('Are you sure you want to delete the folder?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete folder', "submit.php?id=$id", 'yes'),
        Page\imageLink('No, return back', "../?id=$id", 'no')
    )
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Received Folder #$id", $content, '../../../../');
