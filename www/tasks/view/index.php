<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id) = require_task($mysqli);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tags.php';
include_once '../../fns/date_ago.php';
include_once '../../fns/render_external_links.php';
include_once '../../lib/page.php';

unset(
    $_SESSION['tasks/edit_errors'],
    $_SESSION['tasks/edit_lastpost'],
    $_SESSION['tasks/index_messages']
);

$options = array();
if ($task->done) {
    $options[] = Page::imageLink(
        'Mark as Not Done',
        "submit-set-done.php?id=$id",
        'task'
    );
} else {
    $options[] = Page::imageLink(
        'Mark as Done',
        "submit-set-done.php?id=$id&done=1",
        'task-done'
    );
}
$options[] = Page::imageLink('Edit Task', "../edit/?id=$id", 'edit-task');
$options[] = Page::imageLink('Delete Task', "../delete/?id=$id", 'trash-bin');

$tasktext = $task->tasktext;
$inserttime = $task->inserttime;
$updatetime = $task->updatetime;

include_once __DIR__.'/../../fns/TaskTags/indexOnTask.php';
$tags = TaskTags\indexOnTask($mysqli, $id);

$base = '../../';

if (array_key_exists('tasks/view/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['tasks/view/index_messages']);
} else {
    $pageMessages = '';
}

include_once '../../fns/create_tabs.php';

$page->base = $base;
$page->title = "Task #$id";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => 'Tasks',
                'href' => '..',
            ],
        ],
        "Task #$id",
        $pageMessages
        .Page::text(
            nl2br(
                render_external_links(htmlspecialchars($tasktext), $base)
            )
        )
        .create_tags('../', $tags)
        .Page::HR
        .Page::text(
            '<div>Task created '.date_ago($inserttime).'.</div>'
            .($inserttime != $updatetime ? '<div>Last modified '.date_ago($updatetime).'.</div>' : '')
        )
    )
    .create_panel('Options', join(Page::HR, $options))
);
