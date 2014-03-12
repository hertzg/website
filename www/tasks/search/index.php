<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once 'fns/require_keyword_and_tag.php';
list($keyword, $tag) = require_keyword_and_tag();

$items = array();

$searchAction = './';
$searchPlaceholder = 'Search tasks...';

include_once '../../fns/SearchForm/content.php';
include_once '../../fns/SearchForm/create.php';
include_once '../../lib/mysqli.php';

if ($tag === '') {

    $filterMessage = '';

    include_once '../../fns/Tasks/search.php';
    $tasks = Tasks\search($mysqli, $idusers, $keyword);

    $formContent = SearchForm\content($keyword, $searchPlaceholder, '..');
    $items[] = SearchForm\create($searchAction, $formContent);

    if (count($tasks) > 1) {

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
    $tasks = TaskTags\searchOnTagName($mysqli, $idusers, $keyword, $tag);

    $clearHref = '../?tag='.rawurlencode($tag);
    $formContent =
        SearchForm\content($keyword, $searchPlaceholder, $clearHref)
        .'<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />';

    $items[] = SearchForm\create($searchAction, $formContent);

    $clearHref = '?'.htmlspecialchars(
        http_build_query(array('keyword' => $keyword))
    );
    include_once '../../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, $clearHref);

}

include_once '../fns/render_tasks.php';
render_tasks($tasks, $items, '../');

unset(
    $_SESSION['home/index_messages'],
    $_SESSION['tasks/new/index_errors'],
    $_SESSION['tasks/new/index_lastpost'],
    $_SESSION['tasks/view/index_messages']
);

include_once '../fns/create_options_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../..',
            ),
        ),
        'Tasks',
        Page\sessionMessages('tasks/index_messages')
        .$filterMessage.join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user, '../');

include_once '../../fns/echo_page.php';
echo_page($user, 'Tasks', $content, $base);
