<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

unset(
    $_SESSION['bookmarks/edit/errors'],
    $_SESSION['bookmarks/edit/values'],
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages'],
    $_SESSION['bookmarks/send/errors'],
    $_SESSION['bookmarks/send/messages'],
    $_SESSION['bookmarks/send/values']
);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../fns/get_revision.php';
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once '../fns/ViewPage/create.php';
$content =
    ViewPage\create($mysqli, $user, $bookmark)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"../../js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js?1"></script>';

include_once '../../fns/echo_page.php';
echo_page($user, "Bookmark #$id", $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css"'
        .' href="../../confirmDialog.compressed.css" />',
]);
