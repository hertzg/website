<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id) = require_task($mysqli);

include_once '../../lib/page.php';

unset(
    $_SESSION['tasks/edit_errors'],
    $_SESSION['tasks/edit_lastpost'],
    $_SESSION['tasks/index_messages']
);

$options = array();
if ($task->top_priority) {
    $options[] = Page::imageLink('Mark as Normal Priority',
        "submit-set-normal-priority.php?id=$id", 'task');
} else {
    $options[] = Page::imageLink('Mark as Top Priority',
        "submit-set-top-priority.php?id=$id", 'task-top-priority');
}
$options[] = Page::imageArrowLink('Edit Task', "../edit/?id=$id", 'edit-task');
$options[] = Page::imageArrowLink('Delete Task', "../delete/?id=$id", 'trash-bin');

$tasktext = $task->tasktext;
$inserttime = $task->inserttime;
$updatetime = $task->updatetime;

include_once __DIR__.'/../../fns/TaskTags/indexOnTask.php';
$tags = TaskTags\indexOnTask($mysqli, $id);

$base = '../../';

if (array_key_exists('tasks/view/index_messages', $_SESSION)) {
    include_once '../../fns/Page/messages.php';
    $pageMessages = Page\messages($_SESSION['tasks/view/index_messages']);
} else {
    $pageMessages = '';
}

include_once '../../fns/date_ago.php';
$infoText = '<div>Task created '.date_ago($inserttime).'.</div>';
if ($inserttime != $updatetime) {
    $infoText .= '<div>Last modified '.date_ago($updatetime).'.</div>';
}

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/create_tags.php';
include_once '../../fns/render_external_links.php';

$page->base = $base;
$page->title = "Task #$id";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Tasks',
                'href' => '..',
            ),
        ),
        "Task #$id",
        $pageMessages
        .Page::text(
            nl2br(
                render_external_links(htmlspecialchars($tasktext), $base)
            )
        )
        .create_tags('../', $tags)
        .Page::HR
        .Page::text($infoText)
    )
    .create_panel('Options', join(Page::HR, $options))
);
