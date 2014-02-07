<?php

include_once 'lib/require-task.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

unset($_SESSION['tasks/view/index_messages']);

$page->base = '../../';
$page->title = "Delete Task #$id?";
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '../..')
        .Tab::item('Tasks', '..')
        .Tab::activeItem("Task #$id"),
        Page::text('Are you sure you want to delete the task?')
        .Page::HR
        .Page::imageLink('Yes, delete task', "submit.php?id=$id", 'yes')
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
