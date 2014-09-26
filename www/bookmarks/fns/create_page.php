<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $id_users = $user->id_users;

    include_once "$fnsDir/request_strings.php";
    list($tag, $offset) = request_strings('tag', 'offset');

    $items = [];

    $searchAction = "{$base}search/";
    $searchPlaceholder = 'Search bookmarks...';

    $offset = abs((int)$offset);

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    if ($offset % $limit) {
        include_once "$fnsDir/redirect.php";
        redirect();
    }

    if ($tag === '') {

        $filterMessage = '';

        include_once "$fnsDir/Bookmarks/indexPageOnUser.php";
        $bookmarks = Bookmarks\indexPageOnUser($mysqli,
            $id_users, $offset, $limit, $total);

        if ($total > 1) {

            include_once "$fnsDir/SearchForm/emptyContent.php";
            $formContent = SearchForm\emptyContent($searchPlaceholder);

            include_once "$fnsDir/SearchForm/create.php";
            $items[] = SearchForm\create($searchAction, $formContent);

            include_once "$fnsDir/BookmarkTags/indexOnUser.php";
            $tags = BookmarkTags\indexOnUser($mysqli, $id_users);

            if ($tags) {
                include_once "$fnsDir/create_tag_filter_bar.php";
                $filterMessage = create_tag_filter_bar($tags, []);
            }

        }

    } else {

        include_once "$fnsDir/BookmarkTags/indexOnTagName.php";
        $bookmarks = BookmarkTags\indexOnTagName($mysqli, $id_users, $tag,
            $offset, $limit, $total);

        if ($total > 1) {

            include_once "$fnsDir/Form/hidden.php";
            include_once "$fnsDir/SearchForm/emptyContent.php";
            $formContent =
                SearchForm\emptyContent($searchPlaceholder)
                .Form\hidden('tag', $tag);

            include_once "$fnsDir/SearchForm/create.php";
            $items[] = SearchForm\create($searchAction, $formContent);

        }

        include_once "$fnsDir/create_clear_filter_bar.php";
        $filterMessage = create_clear_filter_bar($tag, "$base./");

    }

    include_once __DIR__.'/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $tag);

    $params = [];
    if ($tag !== '') $params['tag'] = $tag;
    if ($offset) $params['offset'] = $offset;
    include_once __DIR__.'/render_bookmarks.php';
    render_bookmarks($bookmarks, $items, $params, $base);

    include_once __DIR__.'/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $tag);

    include_once __DIR__.'/unset_session_vars.php';
    unset_session_vars();

    include_once __DIR__.'/create_content.php';
    return create_content($user, $filterMessage, $items, $base);

}
