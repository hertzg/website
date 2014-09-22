<?php

include_once '../fns/create_view_page.php';
include_once '../../lib/mysqli.php';
$content = create_view_page($mysqli, $user, $id);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['calendar/view-event/messages']);

include_once "$fnsDir/Page/confirmDialog.php";
$content .= Page\confirmDialog('Are you sure you want to delete the event?',
    'Yes, delete event', "submit.php?id=$id", "../view-event/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Event #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
