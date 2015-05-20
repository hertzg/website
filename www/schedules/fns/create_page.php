<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $id_users = $user->id_users;

    include_once "$fnsDir/request_strings.php";
    list($tag) = request_strings('tag');

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset();

    $items = [];

    $searchAction = "{$base}search/";
    $searchPlaceholder = 'Search schedules...';

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    $searchForm = false;

    if ($tag === '') {

        $filterMessage = '';

        include_once "$fnsDir/Schedules/indexOnUser.php";
        $schedules = Schedules\indexOnUser($mysqli, $id_users);
        $total = count($schedules);

        if ($total > 1) {

            include_once "$fnsDir/SearchForm/emptyContent.php";
            $formContent = SearchForm\emptyContent($searchPlaceholder);

            include_once "$fnsDir/SearchForm/create.php";
            $items[] = SearchForm\create($searchAction, $formContent);
            $searchForm = true;

            include_once "$fnsDir/ScheduleTags/indexOnUser.php";
            $tags = \ScheduleTags\indexOnUser($mysqli, $id_users);

            if ($tags) {
                include_once "$fnsDir/create_tag_filter_bar.php";
                $filterMessage = create_tag_filter_bar($tags, []);
            }

        }

    } else {

        include_once "$fnsDir/ScheduleTags/indexOnTagName.php";
        $schedules = ScheduleTags\indexOnTagName($mysqli, $id_users, $tag);
        $total = count($schedules);

        if ($total > 1) {

            include_once "$fnsDir/Form/hidden.php";
            include_once "$fnsDir/SearchForm/emptyContent.php";
            $formContent =
                SearchForm\emptyContent($searchPlaceholder)
                .Form\hidden('tag', $tag);

            include_once "$fnsDir/SearchForm/create.php";
            $items[] = SearchForm\create($searchAction, $formContent);
            $searchForm = true;

        }

        include_once "$fnsDir/create_clear_filter_bar.php";
        $filterMessage = create_clear_filter_bar($tag, $base);

    }

    include_once __DIR__.'/sort_schedules.php';
    sort_schedules($user, $schedules);
    $schedules = array_slice($schedules, $offset, $limit);

    $params = [];
    if ($tag !== '') $params['tag'] = $tag;
    if ($offset) $params['offset'] = $offset;

    include_once "$fnsDir/check_offset_overflow.php";
    check_offset_overflow($offset, $limit, $total, $params);

    include_once __DIR__.'/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/render_schedules.php';
    render_schedules($user, $schedules, $items, $params, $base);

    include_once __DIR__.'/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/unset_session_vars.php';
    unset_session_vars();

    include_once __DIR__.'/create_content.php';
    return create_content($user, $filterMessage, $items, $base, $searchForm);

}
