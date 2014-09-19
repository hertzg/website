<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

unset(
    $_SESSION['contacts/edit/errors'],
    $_SESSION['contacts/edit/values'],
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages'],
    $_SESSION['contacts/send/errors'],
    $_SESSION['contacts/send/messages'],
    $_SESSION['contacts/send/values']
);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../fns/get_revision.php';
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once '../fns/ViewPage/create.php';
$content =
    ViewPage\create($mysqli, $contact)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"../../js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php$itemQuery")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once '../../fns/get_revision.php';
$cssRevision = get_revision('css/contact/compressed.css');

include_once '../../fns/echo_page.php';
echo_page($user, "Contact #$id", $content, '../../', [
    'head' =>
        '<link rel="stylesheet" type="text/css"'
        ." href=\"../../css/contact/compressed.css?$cssRevision\" />"
        .'<link rel="stylesheet" type="text/css"'
        .' href="../../css/confirmDialog/compressed.css" />',
]);
