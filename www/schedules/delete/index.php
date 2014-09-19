<?php

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

unset($_SESSION['schedules/view/messages']);

include_once '../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/create_view_page.php';
include_once '../../fns/Page/confirmDialog.php';
$content =
    create_view_page($schedule)
    .Page\confirmDialog('Are you sure you want to delete the schedule?',
        'Yes, delete schedule', "submit.php$escapedItemQuery",
        "../view/$escapedItemQuery");

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Schedule #$id?", $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css"'
        .' href="../../confirmDialog.compressed.css" />',
]);
