<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

unset($_SESSION['contacts/view/messages']);

include_once '../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once '../../fns/Page/confirmDialog.php';
$content =
    ViewPage\create($mysqli, $contact)
    .Page\confirmDialog('Are you sure you want to delete the contact?'
        .' It will be moved to Trash.', 'Yes, delete contact',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once '../../fns/get_revision.php';
$cssRevision = get_revision('contact.compressed.css');

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Contact #$id?", $content, '../../', [
    'head' =>
        '<link rel="stylesheet" type="text/css"'
        ." href=\"../../contact.compressed.css?$cssRevision\" />"
        .'<link rel="stylesheet" type="text/css"'
        .' href="../../confirmDialog.compressed.css" />',
]);
