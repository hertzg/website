<?php

include_once 'lib/require-task.php';
include_once '../../fns/create_panel.php';
include_once '../../fns/create_tags.php';
include_once '../../fns/date_ago.php';
include_once '../../fns/render_external_links.php';
include_once '../../classes/Tab.php';
include_once '../../classes/TaskTags.php';
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

$base = '../../';

if (array_key_exists('tasks/view/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['tasks/view/index_messages']);
} else {
    $pageMessages = '';
}

$page->base = $base;
$page->title = "Task #$id";
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '../..')
        .Tab::item('Tasks', '..')
        .Tab::activeItem("Task #$id"),
        $pageMessages
        .Page::text(
            nl2br(
                render_external_links(htmlspecialchars($tasktext), $base)
            )
        )
        .create_tags('../', TaskTags::indexOnTask($id))
        .Page::HR
        .Page::text(
            '<div>Task created '.date_ago($inserttime).'.</div>'
            .($inserttime != $updatetime ? '<div>Last modified '.date_ago($updatetime).'.</div>' : '')
        )
    )
    .create_panel('Options', join(Page::HR, $options))
);
