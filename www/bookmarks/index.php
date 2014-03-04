<?php

function create_search_form ($content) {
    return
        '<form action="./" style="height: 48px; position: relative">'
            .$content
        .'</form>';
}

function createTagInput ($tag) {
    return '<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />';
}

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/create_panel.php';
include_once '../lib/mysqli.php';
include_once '../lib/page.php';

include_once '../fns/request_strings.php';
list($keyword, $tag) = request_strings('keyword', 'tag');

$items = array();
$filterMessage = '';

if ($keyword === '') {
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
                .createTagInput($tag)
            );
        }

        include_once '../fns/create_clear_filter_bar.php';
        $filterMessage = create_clear_filter_bar($tag, './');

    }
    if ($tag === '') {

        include_once '../fns/Bookmarks/indexOnUser.php';
        $bookmarks = Bookmarks\indexOnUser($mysqli, $idusers);

        if (count($bookmarks) > 1) {

            include_once '../fns/BookmarkTags/indexOnUser.php';
            $bookmarkTags = BookmarkTags\indexOnUser($mysqli, $idusers);

            if ($bookmarkTags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($bookmarkTags, array());
            }

        }

    } else {

        include_once '../fns/BookmarkTags/indexOnTagName.php';
        $bookmarks = BookmarkTags\indexOnTagName($mysqli, $idusers, $tag);

        include_once '../fns/create_clear_filter_bar.php';
        $filterMessage = create_clear_filter_bar($tag, './');

    }
} else {
    include_once '../fns/create_search_form_content.php';
    if ($tag === '') {

        include_once '../fns/Bookmarks/search.php';
        $bookmarks = Bookmarks\search($mysqli, $idusers, $keyword);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search bookmarks...', './')
        );
        if (count($bookmarks) > 1) {

            include_once '../fns/BookmarkTags/indexOnUser.php';
            $tags = BookmarkTags\indexOnUser($mysqli, $idusers);

            if ($tags) {
                include_once '../fns/create_tag_filter_bar.php';
                $filterMessage = create_tag_filter_bar($tags, array(
                    'keyword' => $keyword,
                ));
            }

        }

    } else {

        include_once '../fns/BookmarkTags/searchOnTagName.php';
        $bookmarks = BookmarkTags\searchOnTagName($mysqli, $idusers, $keyword, $tag);

        $items[] = create_search_form(
            create_search_form_content($keyword, 'Search bookmarks...', '?tag='.rawurlencode($tag))
            .createTagInput($tag)
        );

        $clearHref = '?'.htmlspecialchars(
            http_build_query(array('keyword' => $keyword))
        );
        include_once '../fns/create_clear_filter_bar.php';
        $filterMessage = create_clear_filter_bar($tag, $clearHref);

    }
}

include_once 'fns/render_bookmarks.php';
render_bookmarks($bookmarks, $items);

if (array_key_exists('bookmarks/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['bookmarks/index_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['bookmarks/new/index_errors'],
    $_SESSION['bookmarks/new/index_lastpost'],
    $_SESSION['bookmarks/view/index_messages'],
    $_SESSION['home/index_messages']
);

$options = array(
    Page::imageArrowLink('New Bookmark', 'new/', 'create-bookmark'),
);
if ($bookmarks) {
    $options[] = Page::imageArrowLink('Delete All Bookmarks',
        'delete-all/', 'trash-bin');
}

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
    .create_panel('Options', join(Page::HR, $options))
);
