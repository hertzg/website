<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

unset($_SESSION['tasks/view/messages']);

include_once '../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once '../../fns/Page/confirmDialog.php';
$content =
    ViewPage\create($mysqli, $task)
    .Page\confirmDialog('Are you sure you want to delete the task?'
        .' It will be moved to Trash.', 'Yes, delete task',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Task #$id?", $content, '../../', [
    'head' => '<link rel="stylesheet" type="text/css"'
        .' href="../../css/confirmDialog/compressed.css" />',
]);
