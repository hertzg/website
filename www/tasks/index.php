<?php

function create_search_form ($content) {
    return
        '<form action="search/" style="height: 48px; position: relative">'
            .$content
        .'</form>';
}

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/request_strings.php';
list($tag) = request_strings('tag');

$items = array();
$filterMessage = '';

include_once '../lib/mysqli.php';
include_once '../lib/page.php';

if ($tag === '') {

    include_once '../fns/Tasks/indexOnUser.php';
    $tasks = Tasks\indexOnUser($mysqli, $idusers);

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
            .'<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />'
        );
    }

    include_once '../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, './');

}

include_once 'fns/render_tasks.php';
render_tasks($tasks, $items);

include_once '../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('tasks/index_messages');

unset(
    $_SESSION['home/index_messages'],
    $_SESSION['tasks/new/index_errors'],
    $_SESSION['tasks/new/index_lastpost'],
    $_SESSION['tasks/view/index_messages']
);

include_once 'fns/create_options_panel.php';
include_once '../fns/create_tabs.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Tasks',
        $pageMessages.$filterMessage.join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user);

include_once '../fns/echo_page.php';
echo_page($user, 'Tasks', $content, '../');
