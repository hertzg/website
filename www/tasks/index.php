<?php

include_once 'lib/require-user.php';
include_once '../fns/ifset.php';
include_once '../fns/request_strings.php';
include_once '../classes/Tasks.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

list($tag) = request_strings('tag');

if ($tag) {
    $filterMessage = Page::warnings(array(
        'Showing tasks with <b>'.htmlspecialchars($tag).'</b> tag.<br />'
        .'<a class="a" href="index.php">Show all</a>',
    ));
    $tasks = Tasks::indexOnTag($idusers, $tag);
} else {
    $filterMessage = '';
    $tasks = Tasks::index($idusers);
}

$tasksHtml = '';
foreach ($tasks as $i => $task) {
    if ($i) $tasksHtml .= Page::HR;
    $icon = $task->done ? 'task-done' : 'task';
    $title = htmlspecialchars($task->tasktext);
    $href = "view.php?id=$task->idtasks";
    $tags = $task->tags;
    if ($tags) {
        $tasksHtml .= Page::imageLinkWithDescription($title, 'Tags: '.htmlspecialchars($tags), $href, $icon);
    } else {
        $tasksHtml .= Page::imageLink($title, $href, $icon);
    }
}
if (!$tasksHtml) {
    $tasksHtml .= Page::info('No tasks.');
}

unset(
    $_SESSION['tasks/add_errors'],
    $_SESSION['tasks/edit_errors'],
    $_SESSION['tasks/view_messages'],
    $_SESSION['home_messages']
);

$page->base = '../';
$page->title = 'Tasks';
$page->finish(
    Tab::create(
        Tab::item('Home', '../home.php')
        .Tab::activeItem('Tasks')
    )
    .Page::messages(ifset($_SESSION['tasks/index_messages']))
    .$filterMessage
    .$tasksHtml
    .Tab::create(
        Tab::activeItem('Options')
    )
    .Page::imageLink('New Task', 'add.php', 'create-task')
);
