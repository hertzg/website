<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_event.php';
include_once '../../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['calendar/all-events/view/messages']);

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($user, $event, $head, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the event?'
        .' It will be moved to Trash.', 'Yes, delete event',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Event #$id?", $content, $base, [
    'head' => $head.compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
