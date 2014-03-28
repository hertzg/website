<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../fns/request_strings.php';
list($tag, $offset) = request_strings('tag', 'offset');

$items = [];
$filterMessage = '';

include_once '../lib/mysqli.php';

$searchAction = 'search/';
$searchPlaceholder = 'Search tasks...';

$offset = abs((int)$offset);

include_once '../fns/Paging/limit.php';
$limit = Paging\limit();

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
            $filterMessage = create_tag_filter_bar($tags, []);
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
render_prev_button($offset, $limit, $total, $items, $tag);

include_once 'fns/render_tasks.php';
render_tasks($tasks, $items, 'No tasks');

include_once 'fns/render_next_button.php';
render_next_button($offset, $limit, $total, $items, $tag);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/create_content.php';
$content = create_content($user, $filterMessage, $items);

include_once '../fns/echo_page.php';
echo_page($user, 'Tasks', $content, $base);
