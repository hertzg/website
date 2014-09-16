<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset($_SESSION['bookmarks/view/messages']);

include_once '../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

$yesHref = "submit.php$escapedItemQuery";
$noHref = "../view/$escapedItemQuery";

include_once '../../fns/Page/confirmDialog.php';
$addition = Page\confirmDialog('Are you sure you want to delete the bookmark?'
    .' It will be moved to Trash.', 'Yes, delete bookmark',
    $yesHref, $noHref);

include_once '../fns/ViewPage/create.php';
$content = ViewPage\create($mysqli, $user, $bookmark, $addition);

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Bookmark #$id?", $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css"'
        .' href="../../confirmDialog.compressed.css" />',
]);
