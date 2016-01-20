<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

unset($_SESSION['tasks/view/messages']);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/TaskRevisions/indexOnTask.php";
include_once '../../lib/mysqli.php';
$revisions = TaskRevisions\indexOnTask($mysqli, $id);

$items = [];
include_once "$fnsDir/export_date_ago.php";
include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
foreach ($revisions as $revision) {
    $item_id = $revision->id;
    $items[] = Page\imageArrowLinkWithDescription(
        export_date_ago($revision->insert_time, true),
        'R'.($revision->revision + 1), "view/?id=$item_id",
        'restore-defaults', ['id' => $item_id]);
}

include_once "$fnsDir/Page/create.php";
$content = \Page\create(
    [
        'title' => "Task #$id",
        'href' => "../view/?id=$id#history",
    ],
    'History',
    join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Task #$id History", $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
