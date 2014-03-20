<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../fns/request_strings.php';
list($tag, $offset) = request_strings('tag', 'offset');

$items = array();
$filterMessage = '';

include_once '../lib/mysqli.php';

$searchAction = 'search/';
$searchPlaceholder = 'Search tasks...';

$offset = abs((int)$offset);
$limit = 20;

if ($tag === '') {

    include_once '../fns/Tasks/indexOnUser.php';
    $tasks = Tasks\indexOnUser($mysqli, $idusers,
        $offset, $limit, $total);

    if ($total > 1) {

        include_once '../fns/SearchForm/emptyContent.php';
        $formContent = SearchForm\emptyContent($searchPlaceholder);

        include_once '../fns/SearchForm/create.php';
        $items[] = SearchForm\create($searchAction, $formContent);

        include_once '../fns/TaskTags/indexOnUser.php';
        $tags = TaskTags\indexOnUser($mysqli, $idusers);
        if ($tags) {
            include_once '../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($tags, array());
        }

    }

} else {

    include_once '../fns/TaskTags/indexOnTagName.php';
    $tasks = TaskTags\indexOnTagName($mysqli, $idusers, $tag,
        $offset, $limit, $total);

    if ($total > 1) {

        include_once '../fns/SearchForm/emptyContent.php';
        include_once '../fns/Form/hidden.php';
        $formContent =
            SearchForm\emptyContent($searchPlaceholder)
            .Form\hidden('tag', $tag);

        include_once '../fns/SearchForm/create.php';
        $items[] = SearchForm\create($searchAction, $formContent);

    }

    include_once '../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, './');

}

include_once 'fns/render_prev_button.php';
render_prev_button($offset, $limit, $items, $tag);

include_once 'fns/render_tasks.php';
render_tasks($tasks, $items, 'No tasks.');

include_once 'fns/render_next_button.php';
render_next_button($offset, $limit, $total, $items, $tag);

unset(
    $_SESSION['home/index_messages'],
    $_SESSION['tasks/new/index_errors'],
    $_SESSION['tasks/new/index_lastpost'],
    $_SESSION['tasks/view/index_messages']
);

include_once 'fns/create_options_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../home/',
            ),
        ),
        'Tasks',
        Page\sessionErrors('tasks/index_errors')
        .Page\sessionMessages('tasks/index_messages')
        .$filterMessage.join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user);

include_once '../fns/echo_page.php';
echo_page($user, 'Tasks', $content, $base);
