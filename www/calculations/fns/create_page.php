<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $id_users = $user->id_users;
    $order_by = $user->calculations_order_by;

    include_once "$fnsDir/request_strings.php";
    list($tag) = request_strings('tag');

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset();

    $items = [];
    $searchForm = false;

    $searchAction = "{$base}search/";
    $searchPlaceholder = 'Search calculations...';

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    if ($tag === '') {

        $filterMessage = '';

        include_once "$fnsDir/Users/Calculations/indexPage.php";
        $calculations = Users\Calculations\indexPage($mysqli,
            $user, $offset, $limit, $total, $order_by);

        if ($total > 1) {

            include_once "$fnsDir/SearchForm/emptyContent.php";
            $formContent = SearchForm\emptyContent($searchPlaceholder);

            include_once "$fnsDir/SearchForm/create.php";
            $items[] = SearchForm\create($searchAction, $formContent);
            $searchForm = true;

            include_once "$fnsDir/CalculationTags/indexOnUser.php";
            $tags = CalculationTags\indexOnUser($mysqli, $id_users);

            if ($tags) {
                include_once "$fnsDir/create_tag_filter_bar.php";
                $filterMessage = create_tag_filter_bar($tags);
            }

        }

    } else {

        include_once "$fnsDir/CalculationTags/indexPageOnUserTagName.php";
        $calculations = CalculationTags\indexPageOnUserTagName($mysqli,
            $id_users, $tag, $offset, $limit, $total, $order_by);

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

    $params = [];
    if ($tag !== '') $params['tag'] = $tag;
    if ($offset) $params['offset'] = $offset;

    include_once "$fnsDir/check_offset_overflow.php";
    check_offset_overflow($offset, $limit, $total, $params);

    include_once __DIR__.'/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/render_calculations.php';
    render_calculations($calculations, $items, $params, $base);

    include_once __DIR__.'/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/unset_session_vars.php';
    unset_session_vars();

    if ($searchForm) {
        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('searchForm', "$base../");
    }

    include_once __DIR__.'/create_content.php';
    return create_content($user, $total, $filterMessage, $items, $base);

}
