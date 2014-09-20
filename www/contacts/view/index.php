<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['contacts/edit/errors'],
    $_SESSION['contacts/edit/values'],
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages'],
    $_SESSION['contacts/send/errors'],
    $_SESSION['contacts/send/messages'],
    $_SESSION['contacts/send/values']
);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once '../fns/ViewPage/create.php';
$content =
    ViewPage\create($mysqli, $contact)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="../view.js"></script>';

include_once "$fnsDir/get_revision.php";
$cssRevision = get_revision('css/contact/compressed.css');

include_once "$fnsDir/echo_page.php";
echo_page($user, "Contact #$id", $content, $base, [
    'head' =>
        '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/contact/compressed.css?$cssRevision\" />"
        .'<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
