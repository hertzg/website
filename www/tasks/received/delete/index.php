<?php

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['tasks/received/view/messages']);

include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
$escapedItemQuery = ItemList\Received\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($receivedTask, $user, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the task?'
        .' It will be moved to Trash.', 'Yes, delete task',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Received Task #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
