<?php

function createSearchForm ($content) {
    return
        '<form action="index.php" style="background: #fff; height: 48px; position: relative">'
            .$content
        .'</form>';
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
    include_once 'fns/create_search_form_empty_content.php';
    if ($tag === '') {
        $tasks = Tasks::index($idusers);
        if (count($tasks) > 1) {
            $items[] = createSearchForm(create_search_form_empty_content());
        }
        $filterMessage = '';
    } else {
        $tasks = Tasks::indexOnTag($idusers, $tag);
        if (count($tasks) > 1) {
            $items[] = createSearchForm(
                createTagInput($tag)
                .create_search_form_empty_content($keyword)
            );
        }
        include_once 'fns/create_filter_message.php';
        $filterMessage = create_filter_message($tag);
    }
} else {
    include_once 'fns/create_search_form_content.php';
    if ($tag === '') {
        $tasks = Tasks::search($idusers, $keyword);
        $items[] = createSearchForm(
            create_search_form_content($keyword)
            .'<a href="index.php" class="clickable"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center; line-height: 48px">'
                .'<div class="icon no" style="vertical-align: middle"></div>'
            .'</a>'
        );
        $filterMessage = '';
    } else {
        $tasks = Tasks::searchOnTag($idusers, $keyword, $tag);
        $items[] = createSearchForm(
            createTagInput($tag)
            .create_search_form_content($keyword)
            .'<a href="index.php?tag='.rawurlencode($tag).'" class="clickable"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center; line-height: 48px">'
                .'<div class="icon no" style="vertical-align: middle"></div>'
            .'</a>'
        );
        include_once 'fns/create_filter_message.php';
        $filterMessage = create_filter_message($tag);
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
