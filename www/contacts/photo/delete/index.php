<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_contact.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['contacts/view/messages']);

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($user, $contact, $head, $scripts, '../')
    .Page\confirmDialog(
        'Are you sure you want to delete the photo of the contact?',
        'Yes, delete photo', "submit.php$escapedItemQuery",
        "../../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Delete Contact Photo?', $content, $base, [
    'head' => $head
        .compressed_css_link('contact', $base)
        .compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
