<?php

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['calendar/view-event/messages']);

include_once '../fns/create_view_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_page($event)
    .Page\confirmDialog('Are you sure you want to delete the event?',
        'Yes, delete event', "submit.php?id=$id", "../view-event/?id=$id");

include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Event #$id?", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
