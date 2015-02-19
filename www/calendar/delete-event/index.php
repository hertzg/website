<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['calendar/view-event/messages']);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($user, $event)
    .Page\confirmDialog('Are you sure you want to delete the event?',
        'Yes, delete event', "submit.php?id=$id", "../view-event/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Event #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
