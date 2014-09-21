<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['bookmarks/edit/errors'],
    $_SESSION['bookmarks/edit/values'],
    $_SESSION['bookmarks/errors'],
    $_SESSION['bookmarks/messages'],
    $_SESSION['bookmarks/send/errors'],
    $_SESSION['bookmarks/send/messages'],
    $_SESSION['bookmarks/send/values']
);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once '../fns/ViewPage/create.php';
$content =
    ViewPage\create($mysqli, $bookmark)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../view.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Bookmark #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
