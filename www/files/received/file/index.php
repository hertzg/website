<?php

include_once 'fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['files/received/file/rename-and-import/errors'],
    $_SESSION['files/received/file/rename-and-import/values'],
    $_SESSION['files/received/messages']
);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once 'fns/create_page.php';
$content =
    create_page($receivedFile)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Received File #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
