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

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/create_panel.php';
include_once '../lib/mysqli.php';
include_once '../lib/page.php';

include_once '../fns/request_strings.php';
list($keyword, $tag) = request_strings('keyword', 'tag');

$items = array();
$filterMessage = '';

if ($keyword === '') {
    if ($tag === '') {

        include_once '../fns/Tasks/index.php';
        $tasks = Tasks\index($mysqli, $idusers);

        if (count($tasks) > 1) {

            include_once '../fns/create_search_form_empty_content.php';
            $items[] = create_search_form(create_search_form_empty_content('Search tasks...'));

            include_once '../fns/TaskTags/indexOnUser.php';
            $tags = TaskTags\indexOnUser($mysqli, $idusers);
            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array());
            }

        }

    } else {

        include_once '../fns/TaskTags/indexOnTagName.php';
        $tasks = TaskTags\indexOnTagName($mysqli, $idusers, $tag);

        if (count($tasks) > 1) {
            include_once '../fns/create_search_form_empty_content.php';
            $items[] = create_search_form(
                create_search_form_empty_content('Search tasks...')
                .createTagInput($tag)
            );
        }

        include_once '../fns/create_clear_filter_bar.php';
        $filterMessage = create_clear_filter_bar($tag, './');

    }
} else {
    include_once '../fns/create_search_form_content.php';
    if ($tag === '') {

        include_once '../fns/Tasks/search.php';
        $tasks = Tasks\search($mysqli, $idusers, $keyword);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search tasks...', './')
        );
        if (count($tasks) > 1) {

            include_once '../fns/TaskTags/indexOnUser.php';
            $tags = TaskTags\indexOnUser($mysqli, $idusers);

            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array(
                    'keyword' => $keyword,
                ));
            }

        }

    } else {

        include_once '../fns/TaskTags/searchOnTagName.php';
        $tasks = TaskTags\searchOnTagName($mysqli, $idusers, $keyword, $tag);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search tasks...', '?tag='.rawurlencode($tag))
            .createTagInput($tag)
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
        $href = "view/?id=$task->idtasks";
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

if (array_key_exists('tasks/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['tasks/index_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['home/index_messages'],
    $_SESSION['tasks/new/index_errors'],
    $_SESSION['tasks/new/index_lastpost'],
    $_SESSION['tasks/view/index_messages']
);

$options = array(Page::imageLink('New Task', 'new/', 'create-task'));
if ($tasks) {
    $options[] = Page::imageLink(
        'Delete All Tasks',
        'delete-all/',
        'trash-bin'
    );
}

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Tasks';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Tasks',
        $pageMessages.$filterMessage.join(Page::HR, $items)
    )
    .create_panel('Options', join(Page::HR, $options))
);
