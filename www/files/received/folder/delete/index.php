<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/require_received_folder.php';
include_once '../../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli, '../');

unset($_SESSION['files/received/folder/messages']);

$base = '../../../../';
$fnsDir = '../../../../fns';

include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
$escapedItemQuery = ItemList\Received\escapedItemQuery($id);

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_page($mysqli, $receivedFolder, $scripts, '../')
    .Page\confirmDialog('Are you sure you want to delete the folder?'
        .' It will be moved to Trash.', 'Yes, delete folder',
        "submit.php$escapedItemQuery", "../$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Received Folder #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
