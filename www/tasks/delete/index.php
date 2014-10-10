<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['tasks/view/messages']);

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($task, $user)
    .Page\confirmDialog('Are you sure you want to delete the task?'
        .' It will be moved to Trash.', 'Yes, delete task',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Task #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
