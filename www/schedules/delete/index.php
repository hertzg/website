<?php

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['schedules/view/messages']);

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/create_view_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_page($user, $schedule)
    .Page\confirmDialog('Are you sure you want to delete the schedule?',
        'Yes, delete schedule', "submit.php$escapedItemQuery",
        "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Schedule #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
