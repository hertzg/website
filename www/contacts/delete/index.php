<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['contacts/view/messages']);

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($contact)
    .Page\confirmDialog('Are you sure you want to delete the contact?'
        .' It will be moved to Trash.', 'Yes, delete contact',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

if ($contact->timezone === null) $scripts = '';
else {
    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('timezoneLabel', $base);
}

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Contact #$id?", $content, $base, [
    'head' => compressed_css_link('contact', $base)
        .compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
