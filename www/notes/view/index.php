<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['notes/edit/errors'],
    $_SESSION['notes/edit/values'],
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages'],
    $_SESSION['notes/send/errors'],
    $_SESSION['notes/send/messages'],
    $_SESSION['notes/send/values']
);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once '../fns/ViewPage/create.php';
$content =
    ViewPage\create($mysqli, $note)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../view.js"></script>';

include_once "$fnsDir/echo_page.php";
echo_page($user, "Note #$id", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
