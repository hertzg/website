<?php

function create_search_form ($content) {
    return
        '<form action="./" style="height: 48px; position: relative">'
            .$content
        .'</form>';
}

function createTagInput ($tag) {
    return '<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />';
}

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../fns/request_strings.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';
include_once '../classes/Tasks.php';

list($tag, $keyword) = request_strings('tag', 'keyword');

$items = array();
$filterMessage = '';

if ($keyword === '') {
    if ($tag === '') {

        $tasks = Tasks::index($idusers);

        if (count($tasks) > 1) {

            include_once '../fns/create_search_form_empty_content.php';
            $items[] = create_search_form(create_search_form_empty_content('Search tasks...'));

            include_once '../classes/TaskTags.php';
            $tags = TaskTags::indexOnUser($idusers);
            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array());
            }

        }

    } else {

        $tasks = Tasks::indexOnTag($idusers, $tag);

        if (count($tasks) > 1) {
            include_once '../fns/create_search_form_empty_content.php';
            $items[] = create_search_form(
                create_search_form_empty_content($keyword, 'Search tasks...')
                .createTagInput($tag)
            );
        }

        include_once '../fns/create_clear_filter_bar.php';
        $filterMessage = create_clear_filter_bar($tag, './');

    }
} else {
    include_once '../fns/create_search_form_content.php';
    if ($tag === '') {

        $tasks = Tasks::search($idusers, $keyword);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search tasks...')
            .'<a href="./" class="clickable" title="Clear Search Keyword"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; position: absolute">'
                .'<div class="icon no" style="position: absolute; top: 0; right: 0; left: 0; bottom: 0; margin: auto">'
                .'</div>'
            .'</a>'
        );
        if (count($tasks) > 1) {
            include_once '../classes/TaskTags.php';
            $tags = TaskTags::indexOnUser($idusers);
            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array(
                    'keyword' => $keyword,
                ));
            }
        }

    } else {

        $tasks = Tasks::searchOnTag($idusers, $keyword, $tag);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search tasks...')
            .createTagInput($tag)
            .'<a href="?tag='.rawurlencode($tag).'" class="clickable" title="Clear Search Keyword"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center; line-height: 48px">'
                .'<div class="icon no" style="position: absolute; top: 0; right: 0; left: 0; bottom: 0; margin: auto">'
                .'</div>'
            .'</a>'
        );

        $clearHref = '?'.htmlspecialchars(
            http_build_query(array('keyword' => $keyword))
        );
        include_once '../fns/create_clear_filter_bar.php';
        $filterMessage = create_clear_filter_bar($tag, $clearHref);

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
        Tab::activeItem('Tasks'),
        Page::messages(ifset($_SESSION['tasks/index_messages']))
        .$filterMessage
        .join(Page::HR, $items)
    )
    .create_panel(
        'Options',
        Page::imageLink('New Task', 'add.php', 'create-task')
    )
);
