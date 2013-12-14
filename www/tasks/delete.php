<?php

include_once 'lib/require-task.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$page->base = '../';
$page->title = 'Delete Task: '.htmlspecialchars(mb_substr($task->tasktext, 0, 20, 'UTF-8'));
$page->finish(
    Tab::create(
        Tab::item('Tasks', 'index.php')
        .Tab::activeItem('View'),
        Page::text('Are you sure you want to delete the task?')
        .Page::HR
        .Page::imageLink('Yes, delete task', "submit-delete.php?id=$id", 'yes')
        .Page::HR
        .Page::imageLink('No, return back', "view.php?id=$id", 'no')
    )
);
