<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$id_users = $user->id_users;

include_once '../fns/request_strings.php';
list($tag, $offset) = request_strings('tag', 'offset');

$items = [];

include_once '../lib/mysqli.php';

$searchAction = 'search/';
$searchPlaceholder = 'Search notes...';

$offset = abs((int)$offset);

include_once '../fns/Paging/limit.php';
$limit = Paging\limit();

if ($offset % $limit) {
    include_once '../fns/redirect.php';
    redirect();
}

if ($tag === '') {

    $filterMessage = '';

    include_once '../fns/Notes/indexPageOnUser.php';
    $notes = Notes\indexPageOnUser($mysqli,
        $id_users, $offset, $limit, $total);

    if ($total > 1) {

        include_once '../fns/SearchForm/emptyContent.php';
        $formContent = SearchForm\emptyContent($searchPlaceholder);

        include_once '../fns/SearchForm/create.php';
        $items[] = SearchForm\create($searchAction, $formContent);

        include_once '../fns/NoteTags/indexOnUser.php';
        $tags = NoteTags\indexOnUser($mysqli, $id_users);
        if ($tags) {
            include_once '../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($tags, []);
        }

    }

} else {

    include_once '../fns/NoteTags/indexOnTagName.php';
    $notes = NoteTags\indexOnTagName($mysqli, $id_users, $tag,
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

$params = [];
if ($tag !== '') $params['tag'] = $tag;
if ($offset) $params['offset'] = $offset;
include_once 'fns/render_notes.php';
render_notes($notes, $items, 'No notes', $params);

include_once 'fns/render_next_button.php';
render_next_button($offset, $limit, $total, $items, $tag);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/create_content.php';
$content = create_content($user, $filterMessage, $items);

include_once '../fns/echo_page.php';
echo_page($user, 'Notes', $content, $base);
