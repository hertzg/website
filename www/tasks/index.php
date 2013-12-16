<?php

function createSearchForm ($content) {
    return
        '<form action="./" style="background: #fff; height: 48px; position: relative">'
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

if ($keyword === '') {
    include_once 'fns/create_search_form_empty_content.php';
    if ($tag === '') {
        $tasks = Tasks::index($idusers);
        if (count($tasks) > 1) {
            $items[] = createSearchForm(create_search_form_empty_content());
            include_once '../classes/TaskTags.php';
            $taskTags = TaskTags::indexOnUser($idusers);
            if ($taskTags) {
                $links = array();
                foreach ($taskTags as $taskTag) {
                    $tagname = $taskTag->tagname;
                    $href = '?'.htmlspecialchars(
                        http_build_query(array(
                            'tag' => $tagname,
                        ))
                    );
                    $links[] =
                        '<li style="display: inline-block">'
                            ."<a class=\"tag\" href=\"$href\">"
                                .htmlspecialchars($tagname)
                            .'</a>'
                        .'</li>';
                }
                $filterMessage = Page::warnings(array(
                    'Filter by tags: <ul style="display: inline">'.join(' ', $links).'</ul>'
                ));
            }
        } else {
            $filterMessage = '';
        }
    } else {
        $tasks = Tasks::indexOnTag($idusers, $tag);
        if (count($tasks) > 1) {
            $items[] = createSearchForm(
                createTagInput($tag)
                .create_search_form_empty_content($keyword)
            );
        }
        $filterMessage = Page::warnings(array(
            'Showing tasks with <b>'.htmlspecialchars($tag).'</b> tag.'
            .' <a class="a" href="./">Show all</a>',
        ));
    }
} else {
    include_once 'fns/create_search_form_content.php';
    if ($tag === '') {
        $tasks = Tasks::search($idusers, $keyword);
        $items[] = createSearchForm(
            create_search_form_content($keyword)
            .'<a href="./" class="clickable"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; position: absolute">'
                .'<div class="icon no" style="position: absolute; top: 0; right: 0; left: 0; bottom: 0; margin: auto"></div>'
            .'</a>'
        );
        if (count($tasks) > 1) {
            include_once '../classes/TaskTags.php';
            $taskTags = TaskTags::indexOnUser($idusers);
            if ($taskTags) {
                $links = array();
                foreach ($taskTags as $taskTag) {
                    $tagname = $taskTag->tagname;
                    $href = '?'.htmlspecialchars(
                        http_build_query(array(
                            'tag' => $tagname,
                            'keyword' => $keyword,
                        ))
                    );
                    $links[] =
                        '<li style="display: inline-block">'
                            ."<a class=\"tag\" href=\"$href\">"
                                .htmlspecialchars($tagname)
                            .'</a>'
                        .'</li>';
                }
                $filterMessage = Page::warnings(array(
                    'Filter by tags: <ul style="display: inline">'.join(' ', $links).'</ul>'
                ));
            }
        } else {
            $filterMessage = '';
        }
    } else {
        $tasks = Tasks::searchOnTag($idusers, $keyword, $tag);
        $items[] = createSearchForm(
            createTagInput($tag)
            .create_search_form_content($keyword)
            .'<a href="?tag='.rawurlencode($tag).'" class="clickable"'
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center; line-height: 48px">'
                .'<div class="icon no" style="position: absolute; top: 0; right: 0; left: 0; bottom: 0; margin: auto"></div>'
            .'</a>'
        );
        $href = '?'.htmlspecialchars(
            http_build_query(array(
                'keyword' => $keyword,
            ))
        );
        $filterMessage = Page::warnings(array(
            'Showing tasks with <b>'.htmlspecialchars($tag).'</b> tag.'
            ." <a class=\"a\" href=\"$href\">Show all</a>",
        ));
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
