<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($keyword, $tag, $offset) = request_strings(
    'keyword', 'tag', 'offset');

if ($keyword === '') {
    $url = '../';
    if ($tag !== '') $url .= '?tag='.rawurlencode($tag);
    include_once '../../fns/redirect.php';
    redirect($url);
}

$items = array();

$offset = abs((int)$offset);

include_once '../../fns/Paging/limit.php';
$limit = Paging\limit();

include_once '../../fns/SearchForm/content.php';
include_once '../../fns/SearchForm/create.php';
include_once '../../lib/mysqli.php';

$searchAction = './';
$searchPlaceholder = 'Search notes...';

if ($tag === '') {

    $filterMessage = '';

    include_once '../../fns/Notes/search.php';
    $notes = Notes\search($mysqli, $idusers, $keyword,
        $offset, $limit, $total);

    $formContent = SearchForm\content($keyword, $searchPlaceholder, '..');
    $items[] = SearchForm\create($searchAction, $formContent);

    if ($total > 1) {

        include_once '../../fns/NoteTags/indexOnUser.php';
        $tags = NoteTags\indexOnUser($mysqli, $idusers);

        if ($tags) {
            include_once '../../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($tags, array(
                'keyword' => $keyword,
            ));
        }

    }

} else {

    include_once '../../fns/NoteTags/searchOnTagName.php';
    $notes = NoteTags\searchOnTagName($mysqli, $idusers, $keyword, $tag,
        $offset, $limit, $total);

    $clearHref = '../?tag='.rawurlencode($tag);
    include_once '../../fns/Form/hidden.php';
    $formContent =
        SearchForm\content($keyword, $searchPlaceholder, $clearHref)
        .Form\hidden('tag', $tag);
    $items[] = SearchForm\create($searchAction, $formContent);

    $clearHref = '?'.htmlspecialchars(
        http_build_query(array('keyword' => $keyword))
    );
    include_once '../../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, $clearHref);

}

include_once 'fns/render_prev_button.php';
render_prev_button($offset, $limit, $items, $keyword, $tag);

include_once '../fns/render_notes.php';
render_notes($notes, $items, 'No notes found.', '../');

include_once 'fns/render_next_button.php';
render_next_button($offset, $limit, $total, $items, $keyword, $tag);

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/create_options_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../../home/',
            ),
        ),
        'Notes',
        Page\sessionMessages('notes/index_messages')
        .$filterMessage.join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user, '../');

include_once '../../fns/echo_page.php';
echo_page($user, 'Notes', $content, $base);
