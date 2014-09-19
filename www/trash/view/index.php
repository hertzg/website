<?php

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli, '../');

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['trash/errors'],
    $_SESSION['trash/messages']
);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once '../fns/ViewPage/create.php';
$content =
    ViewPage\create($deletedItem, $title, $head)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var purgeHref = '.json_encode("../purge/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js?2"></script>';

include_once "$fnsDir/echo_page.php";
echo_page($user, $title, $content, $base, [
    'head' => $head
        .'<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
