<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id) = require_task($mysqli);

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['tasks/view/index_messages']);

$page->base = '../../';
$page->title = "Delete Task #$id?";
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
        Page::text('Are you sure you want to delete the task?')
        .Page::HR
        .Page::imageLink('Yes, delete task', "submit.php?id=$id", 'yes')
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
