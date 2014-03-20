<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once 'fns/require_keyword_and_tag.php';
list($keyword, $tag, $offset) = require_keyword_and_tag();

$items = array();

$searchAction = './';
$searchPlaceholder = 'Search tasks...';

$offset = abs((int)$offset);

include_once '../../fns/Paging/limit.php';
$limit = Paging\limit();

include_once '../../fns/SearchForm/content.php';
include_once '../../fns/SearchForm/create.php';
include_once '../../lib/mysqli.php';

if ($tag === '') {

    $filterMessage = '';

    include_once '../../fns/Tasks/search.php';
    $tasks = Tasks\search($mysqli, $idusers, $keyword,
        $offset, $limit, $total);

    $formContent = SearchForm\content($keyword, $searchPlaceholder, '..');
    $items[] = SearchForm\create($searchAction, $formContent);

    if ($total > 1) {

        include_once '../../fns/TaskTags/indexOnUser.php';
        $tags = TaskTags\indexOnUser($mysqli, $idusers);

        if ($tags) {
            include_once '../../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($tags, array(
                'keyword' => $keyword,
            ));
        }

    }

} else {

    include_once '../../fns/TaskTags/searchOnTagName.php';
    $tasks = TaskTags\searchOnTagName($mysqli, $idusers, $keyword, $tag,
        $offset, $limit, $total);

    $clearHref = '../?tag='.rawurlencode($tag);
    include_once '../../fns/Form/hidden.php';
    $formContent =
        SearchForm\content($keyword, $searchPlaceholder, $clearHref)
        .Form\hidden('tag', htmlspecialchars($tag));

    $items[] = SearchForm\create($searchAction, $formContent);

    $clearHref = '?'.htmlspecialchars(
        http_build_query(array('keyword' => $keyword))
    );
    include_once '../../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, $clearHref);

}

include_once 'fns/render_prev_button.php';
render_prev_button($offset, $limit, $items, $keyword, $tag);

include_once '../fns/render_tasks.php';
render_tasks($tasks, $items, 'No tasks found.', '../');

include_once 'fns/render_next_button.php';
render_next_button($offset, $limit, $total, $items, $keyword, $tag);

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/create_content.php';
$content = create_content($user, $filterMessage, $items);

include_once '../../fns/echo_page.php';
echo_page($user, 'Tasks', $content, $base);
