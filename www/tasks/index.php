<?php

function createFilterMessage ($tag) {
    return Page::warnings(array(
        'Showing tasks with <b>'.htmlspecialchars($tag).'</b> tag.<br />'
        .'<a class="a" href="index.php">Show all</a>',
    ));
}

function createSearchForm ($content) {
    return
        '<form action="index.php" style="background: #fff; height: 48px; position: relative">'
            .$content
        .'</form>';
}

function createSearchFormContent ($keyword) {
    return
        '<div style="position: absolute; top: 0; right: 96px; bottom: 0; left: 0">'
            .'<input type="text" name="keyword" value="'.htmlspecialchars($keyword).'"'
            .' placeholder="Search notes..." style="padding: 0 12px; width: 100%; height: 100%; cursor: text" />'
        .'</div>'
        .'<button class="clickable" style="position: absolute; top: 0; right: 48px; bottom: 0; width: 48px; text-align: center">'
            .'<span class="icon search"></span>'
        .'</button>';
}

function createSearchFormEmptyContent () {
    return
        '<div style="position: absolute; top: 0; right: 48px; bottom: 0; left: 0">'
            .'<input type="text" name="keyword" placeholder="Search tasks..."'
            .' style="padding: 0 12px; width: 100%; height: 100%; cursor: text" />'
        .'</div>'
        .'<button class="clickable" style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center">'
            .'<span class="icon search"></span>'
        .'</button>';
}

function createTagInput ($tag) {
    return '<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />';
}

include_once 'lib/require-user.php';
include_once '../fns/ifset.php';
include_once '../fns/request_strings.php';
include_once '../classes/Tasks.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

list($tag, $keyword) = request_strings('tag', 'keyword');

$items = array();

if ($keyword === '') {
    if ($tag === '') {
        $items[] = createSearchForm(createSearchFormEmptyContent());
        $filterMessage = '';
        $tasks = Tasks::index($idusers);
    } else {
        $items[] = createSearchForm(
            createTagInput($tag)
            .createSearchFormEmptyContent($keyword)
        );
        $filterMessage = createFilterMessage($tag);
        $tasks = Tasks::indexOnTag($idusers, $tag);
    }
} else {
    if ($tag === '') {
        $items[] = createSearchForm(
            createSearchFormContent($keyword)
            .'<a href="index.php" class="clickable"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center; line-height: 48px">'
                .'<div class="icon no" style="vertical-align: middle"></div>'
            .'</a>'
        );
        $filterMessage = '';
        $tasks = Tasks::search($idusers, $keyword);
    } else {
        $items[] = createSearchForm(
            createTagInput($tag)
            .createSearchFormContent($keyword)
            .'<a href="index.php?tag='.rawurlencode($tag).'" class="clickable"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center; line-height: 48px">'
                .'<div class="icon no" style="vertical-align: middle"></div>'
            .'</a>'
        );
        $filterMessage = createFilterMessage($tag);
        $tasks = Tasks::searchOnTag($idusers, $keyword, $tag);
    }
}

if ($tasks) {
    foreach ($tasks as $task) {
        $icon = $task->done ? 'task-done' : 'task';
        $title = htmlspecialchars($task->tasktext);
        $href = "view.php?id=$task->idtasks";
        $tags = $task->tags;
        if ($tags) {
            $items[] = Page::imageLinkWithDescription($title, 'Tags: '.htmlspecialchars($tags), $href, $icon);
        } else {
            $items[] = Page::imageLink($title, $href, $icon);
        }
    }
} else {
    $items[] = Page::info('No tasks.');
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
    .join(Page::HR, $items)
    .Tab::create(
        Tab::activeItem('Options')
    )
    .Page::imageLink('New Task', 'add.php', 'create-task')
);
