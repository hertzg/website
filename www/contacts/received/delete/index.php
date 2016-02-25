<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['contacts/received/view/messages']);

include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
$escapedItemQuery = ItemList\Received\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($user, $receivedContact, $head, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the contact?'
        .' It will be moved to Trash.', 'Yes, delete contact',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Received Contact #$id?", $content, $base, [
    'head' => $head
        .compressed_css_link('contact', $base)
        .compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
