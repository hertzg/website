<?php

namespace SearchPage;

function create ($mysqli, $user, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';
    $id_users = $user->id_users;
    $order_by = $user->bookmarks_order_by;

    include_once "$fnsDir/request_valid_keyword_tag_offset.php";
    list($keyword, $tag, $offset) = request_valid_keyword_tag_offset(
        $includes, $excludes);

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('searchForm', '../../');

    $searchAction = './';
    $searchPlaceholder = 'Search bookmarks...';

    $items = [];

    include_once "$fnsDir/Paging/limit.php";
    $limit = \Paging\limit();

    include_once "$fnsDir/SearchForm/content.php";
    include_once "$fnsDir/SearchForm/create.php";

    if ($tag === '') {

        $filterMessage = '';

        include_once "$fnsDir/Bookmarks/searchPage.php";
        $bookmarks = \Bookmarks\searchPage($mysqli, $id_users,
            $includes, $excludes, $offset, $limit, $total, $order_by);

        $formContent = \SearchForm\content($keyword, $searchPlaceholder, '..');
        $items[] = \SearchForm\create($searchAction, $formContent);

        if ($total > 1) {

            include_once "$fnsDir/BookmarkTags/indexOnUser.php";
            $tags = \BookmarkTags\indexOnUser($mysqli, $id_users);

            if ($tags) {
                include_once "$fnsDir/create_tag_filter_bar.php";
                $filterMessage = create_tag_filter_bar($tags, [
                    'keyword' => $keyword,
                ]);
            }

        }

    } else {

        include_once "$fnsDir/BookmarkTags/searchPageOnUserTagName.php";
        $bookmarks = \BookmarkTags\searchPageOnUserTagName($mysqli, $id_users,
            $includes, $excludes, $tag, $offset, $limit, $total, $order_by);

        include_once "$fnsDir/Form/hidden.php";
        $clearHref = '../?tag='.rawurlencode($tag);
        $formContent =
            \SearchForm\content($keyword, $searchPlaceholder, $clearHref)
            .\Form\hidden('tag', $tag);
        $items[] = \SearchForm\create($searchAction, $formContent);

        $clearHref = '?keyword='.rawurlencode($keyword);
        include_once "$fnsDir/create_clear_filter_bar.php";
        $filterMessage = create_clear_filter_bar($tag, $clearHref);

    }

    $params = ['keyword' => $keyword];
    if ($tag !== '') $params['tag'] = $tag;
    if ($offset) $params['offset'] = $offset;

    include_once "$fnsDir/check_offset_overflow.php";
    check_offset_overflow($offset, $limit, $total, $params);

    include_once __DIR__.'/../render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/renderBookmarks.php';
    renderBookmarks($bookmarks, $items, $params, $includes);

    include_once __DIR__.'/../render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/../unset_session_vars.php';
    unset_session_vars();

    include_once __DIR__.'/createContent.php';
    return createContent($user, $total, $filterMessage, $items, $keyword);

}
