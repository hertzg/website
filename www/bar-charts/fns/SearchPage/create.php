<?php

namespace SearchPage;

function create ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';
    $id_users = $user->id_users;

    include_once "$fnsDir/request_valid_keyword_tag_offset.php";
    list($keyword, $tag, $offset) = request_valid_keyword_tag_offset();

    $searchAction = './';
    $searchPlaceholder = 'Search bar charts...';

    $items = [];

    include_once "$fnsDir/Paging/limit.php";
    $limit = \Paging\limit();

    include_once "$fnsDir/SearchForm/content.php";
    include_once "$fnsDir/SearchForm/create.php";

    if ($tag === '') {

        $filterMessage = '';

        include_once "$fnsDir/BarCharts/searchPage.php";
        $bar_charts = \BarCharts\searchPage($mysqli,
            $user->id_users, $keyword, $offset, $limit, $total);

        $formContent = \SearchForm\content($keyword, $searchPlaceholder, '..');
        $items[] = \SearchForm\create($searchAction, $formContent);

        if ($total > 1) {

            include_once "$fnsDir/BarChartTags/indexOnUser.php";
            $tags = \BarChartTags\indexOnUser($mysqli, $id_users);

            if ($tags) {
                include_once "$fnsDir/create_tag_filter_bar.php";
                $filterMessage = create_tag_filter_bar($tags, [
                    'keyword' => $keyword,
                ]);
            }

        }

    } else {

        include_once "$fnsDir/BarChartTags/searchPageOnUserTagName.php";
        $bar_charts = \BarChartTags\searchPageOnUserTagName($mysqli,
            $id_users, $keyword, $tag, $offset, $limit, $total);

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

    include_once __DIR__.'/renderBarCharts.php';
    renderBarCharts($bar_charts, $items, $params, $keyword);

    include_once __DIR__.'/../render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/../unset_session_vars.php';
    unset_session_vars();

    include_once __DIR__.'/../create_options_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/compressed_js_script.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../../home/#bar-charts',
                ],
            ],
            'Bar Charts',
            \Page\sessionMessages('bar-charts/messages')
            .$filterMessage
            .join('<div class="hr"></div>', $items),
            create_new_item_button('Bar Chart', '../')
        )
        .create_options_panel($user, '../')
        .compressed_js_script('searchForm', '../../');

}
