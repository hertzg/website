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

    include_once '../fns/Bookmarks/indexOnUser.php';
    $bookmarks = Bookmarks\indexOnUser($mysqli, $idusers);

    if (count($bookmarks) > 1) {

        include_once '../fns/create_search_form_empty_content.php';
        $items[] = create_search_form(create_search_form_empty_content('Search bookmarks...'));

        include_once '../fns/BookmarkTags/indexOnUser.php';
        $tags = BookmarkTags\indexOnUser($mysqli, $idusers);
        if ($tags) {
            include_once '../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($tags, array());
        }

    }

} else {

    include_once '../fns/BookmarkTags/indexOnTagName.php';
    $bookmarks = BookmarkTags\indexOnTagName($mysqli, $idusers, $tag);

    if (count($bookmarks) > 1) {
        include_once '../fns/create_search_form_empty_content.php';
        $items[] = create_search_form(
            create_search_form_empty_content('Search bookmarks...')
            .'<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />'
        );
    }

    include_once '../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, './');

}

include_once 'fns/render_bookmarks.php';
render_bookmarks($bookmarks, $items);

include_once '../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('bookmarks/index_messages');

unset(
    $_SESSION['bookmarks/new/index_errors'],
    $_SESSION['bookmarks/new/index_lastpost'],
    $_SESSION['bookmarks/view/index_messages'],
    $_SESSION['home/index_messages']
);

include_once 'fns/create_options_panel.php';
include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Bookmarks';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Bookmarks',
        $pageMessages.$filterMessage.join(Page::HR, $items)
    )
    .create_options_panel($user)
);
