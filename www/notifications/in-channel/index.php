<?php

$base = '../../';
$fnsDir = '../../fns';

include_once 'fns/create_page.php';
include_once '../../lib/mysqli.php';
$content = create_page($mysqli, $user, $id);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

$content .=
    '<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../in-channel.js">'
    .'</script>';

unset(
    $_SESSION['home/messages'],
    $_SESSION['notifications/channels/messages'],
    $_SESSION['notifications/errors'],
    $_SESSION['notifications/messages']
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Notifications', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
