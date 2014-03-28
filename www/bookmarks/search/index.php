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
$searchPlaceholder = 'Search bookmarks...';

if ($tag === '') {

    $filterMessage = '';

    include_once '../../fns/Bookmarks/searchPage.php';
    $bookmarks = Bookmarks\searchPage($mysqli, $idusers, $keyword,
        $offset, $limit, $total);

    $formContent = SearchForm\content($keyword, $searchPlaceholder, '..');
    $items[] = SearchForm\create($searchAction, $formContent);

    if ($total > 1) {

        include_once '../../fns/BookmarkTags/indexOnUser.php';
        $tags = BookmarkTags\indexOnUser($mysqli, $idusers);

        if ($tags) {
            include_once '../../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($tags, array(
                'keyword' => $keyword,
            ));
        }

    }

} else {

    include_once '../../fns/BookmarkTags/searchOnTagName.php';
    $bookmarks = BookmarkTags\searchOnTagName($mysqli, $idusers, $keyword, $tag,
        $offset, $limit, $total);

    $clearHref = '../?tag='.rawurlencode($tag);
    $formContent = SearchForm\content($keyword, $searchPlaceholder, $clearHref)
        .'<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />';
    $items[] = SearchForm\create($searchAction, $formContent);

    $clearHref = '?'.htmlspecialchars(
        http_build_query(array('keyword' => $keyword))
    );
    include_once '../../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, $clearHref);

}

include_once 'fns/render_prev_button.php';
render_prev_button($offset, $limit, $total, $items, $keyword, $tag);

include_once '../fns/render_bookmarks.php';
render_bookmarks($bookmarks, $items, 'No bookmarks found', '../');

include_once 'fns/render_next_button.php';
render_next_button($offset, $limit, $total, $items, $keyword, $tag);

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/create_content.php';
$content = create_content($user, $filterMessage, $items);

include_once '../../fns/echo_page.php';
echo_page($user, 'Bookmarks', $content, $base);
