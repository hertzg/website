<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset($_SESSION['bookmarks/view/messages']);

include_once '../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once '../../fns/Page/confirmDialog.php';
$content =
    ViewPage\create($mysqli, $bookmark)
    .Page\confirmDialog('Are you sure you want to delete the bookmark?'
        .' It will be moved to Trash.', 'Yes, delete bookmark',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Bookmark #$id?", $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css"'
        .' href="../../css/confirmDialog/compressed.css" />',
]);
