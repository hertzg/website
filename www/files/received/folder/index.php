<?php

include_once 'fns/require_received_folder.php';
include_once '../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['files/received/messages'],
    $_SESSION['files/received/folder/rename-and-import/errors'],
    $_SESSION['files/received/folder/rename-and-import/values']
);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once 'fns/create_page.php';
$content =
    create_page($mysqli, $receivedFolder)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Received Folder #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
