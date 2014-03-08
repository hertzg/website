<?php

function create_search_form ($content) {
    return
        '<form action="./" style="height: 48px; position: relative">'
            .$content
        .'</form>';
}

include_once '../../fns/require_user.php';
require_user('../');

include_once '../../fns/request_strings.php';
list($keyword, $tag) = request_strings('keyword', 'tag');

if ($keyword === '') {
    $url = '../';
    if ($tag !== '') $url .= '?tag='.rawurlencode($tag);
    include_once '../../../fns/redirect.php';
    redirect($url);
}

$items = array();
$filterMessage = '';

include_once '../../fns/create_search_form_content.php';
include_once '../../lib/mysqli.php';
include_once '../../lib/page.php';

if ($tag === '') {

    include_once '../../fns/Bookmarks/search.php';
    $bookmarks = Bookmarks\search($mysqli, $idusers, $keyword);

    $items[] = create_search_form(
        create_search_form_content($keyword, 'Search bookmarks...', '..')
    );
    if (count($bookmarks) > 1) {

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
    $bookmarks = BookmarkTags\searchOnTagName($mysqli, $idusers, $keyword, $tag);

    $clearHref = '../?tag='.rawurlencode($tag);
    $items[] = create_search_form(
        create_search_form_content($keyword, 'Search bookmarks...', $clearHref)
        .'<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />'
    );

    $clearHref = '?'.htmlspecialchars(
        http_build_query(array('keyword' => $keyword))
    );
    include_once '../../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, $clearHref);

}

include_once '../fns/render_bookmarks.php';
render_bookmarks($bookmarks, $items, '../');

include_once '../../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('bookmarks/index_messages');

unset(
    $_SESSION['bookmarks/new/index_errors'],
    $_SESSION['bookmarks/new/index_lastpost'],
    $_SESSION['bookmarks/view/index_messages'],
    $_SESSION['home/index_messages']
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
        'Bookmarks',
        $pageMessages.$filterMessage.join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user, '../');

include_once '../../fns/echo_page.php';
echo_page($user, 'Bookmarks', $content, '../../');
