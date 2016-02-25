<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['calendar/view-event/messages']);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($user, $event, $head, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the event?'
        .' It will be moved to Trash.', 'Yes, delete event',
        "submit.php?id=$id", "../view-event/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Event #$id?", $content, $base, [
    'head' => $head.compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
