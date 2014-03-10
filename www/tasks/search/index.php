<?php

function create_search_form ($content) {
    return
        '<form action="./" style="height: 48px; position: relative">'
            .$content
        .'</form>';
}

include_once '../../fns/require_user.php';
$user = require_user('../');
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($keyword, $tag) = request_strings('keyword', 'tag');

if ($keyword === '') {
    $url = '../';
    if ($tag !== '') $url .= '?tag='.rawurlencode($tag);
    include_once '../../fns/redirect.php';
    redirect($url);
}

$items = array();
$filterMessage = '';

include_once '../../fns/create_search_form_content.php';
include_once '../../lib/mysqli.php';

if ($tag === '') {

    include_once '../../fns/Tasks/search.php';
    $tasks = Tasks\search($mysqli, $idusers, $keyword);

    $items[] = create_search_form(
        create_search_form_content($keyword, 'Search tasks...', '..')
    );
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
    $items[] = create_search_form(
        create_search_form_content($keyword, 'Search tasks...', $clearHref)
        .'<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />'
    );

    $clearHref = '?'.htmlspecialchars(
        http_build_query(array('keyword' => $keyword))
    );
    include_once '../../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, $clearHref);

}

include_once '../fns/render_tasks.php';
render_tasks($tasks, $items, '../');

include_once '../../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('tasks/index_messages');

unset(
    $_SESSION['home/index_messages'],
    $_SESSION['tasks/new/index_errors'],
    $_SESSION['tasks/new/index_lastpost'],
    $_SESSION['tasks/view/index_messages']
);

include_once '../fns/create_options_panel.php';
include_once '../../fns/create_tabs.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../..',
            ),
        ),
        'Tasks',
        $pageMessages.$filterMessage.join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user, '../');

include_once '../../fns/echo_page.php';
echo_page($user, 'Tasks', $content, '../../');
