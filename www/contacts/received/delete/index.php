<?php

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['contacts/received/view/messages']);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($receivedContact)
    .Page\confirmDialog('Are you sure you want to delete the contact?'
        .' It will be moved to Trash.', 'Yes, delete contact',
        "submit.php?id=$id", "../view/?id=$id");

include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Received Contact #$id?", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
