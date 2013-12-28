<?php

include_once 'lib/require-task.php';
include_once '../fns/create_panel.php';
include_once '../fns/create_tags.php';
include_once '../fns/date_ago.php';
include_once '../fns/render_external_links.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';
include_once '../classes/TaskTags.php';

unset(
    $_SESSION['tasks/edit_errors'],
    $_SESSION['tasks/edit_lastpost'],
    $_SESSION['tasks/index_messages']
);

if ($task->done) {
    $setDoneLink = Page::imageLink(
        'Mark as Not Done',
        "submit-set-done.php?id=$id",
        'task'
    );
} else {
    $setDoneLink = Page::imageLink(
        'Mark as Done',
        "submit-set-done.php?id=$id&done=1",
        'task-done'
    );
}

$tasktext = $task->tasktext;
$inserttime = $task->inserttime;
$updatetime = $task->updatetime;

$base = '../';

if (array_key_exists('tasks/view_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['tasks/view_messages']);
} else {
    $pageMessages = '';
}

$page->base = $base;
$page->title = htmlspecialchars(mb_substr($tasktext, 0, 20, 'UTF-8'));
$page->finish(
    Tab::create(
        Tab::item('Tasks', './')
        .Tab::activeItem('View'),
        $pageMessages
        .Page::text(
            nl2br(
                render_external_links(htmlspecialchars($tasktext), $base)
            )
        )
        .create_tags(TaskTags::indexOnTask($id))
        .Page::HR
        .Page::text(
            '<div>Task created '.date_ago($inserttime).'.</div>'
            .($inserttime != $updatetime ? '<div>Last modified '.date_ago($updatetime).'.</div>' : '')
        )
    )
    .create_panel(
        'Options',
        $setDoneLink
        .Page::HR
        .Page::imageLink('Edit Task', "edit.php?id=$id", 'edit-task')
        .Page::HR
        .Page::imageLink('Delete Task', "delete.php?id=$id", 'trash-bin')
    )
);
