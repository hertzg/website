<?php

include_once '../fns/require_received_bookmark.php';
include_once '../../../lib/mysqli.php';
list($receivedBookmark, $id, $user) = require_received_bookmark($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['bookmarks/received/view/messages']);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($receivedBookmark)
    .Page\confirmDialog('Are you sure you want to delete the bookmark?'
        .' It will be moved to Trash.', 'Yes, delete bookmark',
        "submit.php?id=$id", "../view/?id=$id");

include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Received Bookmark #$id?", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
