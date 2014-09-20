<?php

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['contacts/received/edit-and-import/errors'],
    $_SESSION['contacts/received/edit-and-import/values'],
    $_SESSION['contacts/received/messages']
);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');
$cssRevision = get_revision('css/contact/compressed.css');

include_once '../fns/ViewPage/create.php';
$content =
    ViewPage\create($receivedContact)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer"'
    .' src="../../view.js"></script>';
;

include_once "$fnsDir/echo_page.php";
echo_page($user, "Received Contact #$id", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/contact/compressed.css?$cssRevision\" />"
        .'<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />"
]);
