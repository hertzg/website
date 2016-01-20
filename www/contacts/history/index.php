<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

unset($_SESSION['contacts/view/messages']);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ContactRevisions/indexOnContact.php";
include_once '../../lib/mysqli.php';
$revisions = ContactRevisions\indexOnContact($mysqli, $id);

$items = [];
include_once "$fnsDir/export_date_ago.php";
include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
foreach ($revisions as $revision) {
    $item_id = $revision->id;
    $items[] = Page\imageArrowLinkWithDescription(
        export_date_ago($revision->insert_time, true),
        'R'.($revision->revision + 1), "view/?id=$item_id",
        'restore-defaults', ['id' => $item_id]);
}

include_once "$fnsDir/Page/create.php";
$content = \Page\create(
    [
        'title' => "Contact #$id",
        'href' => "../view/?id=$id#history",
    ],
    'History',
    join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Contact #$id History", $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
