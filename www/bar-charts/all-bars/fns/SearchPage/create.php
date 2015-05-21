<?php

namespace SearchPage;

function create ($mysqli, $user, $bar_chart, &$scripts) {

    $id = $bar_chart->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../');

    include_once "$fnsDir/request_valid_keyword_tag_offset.php";
    list($keyword, $tag, $offset) = request_valid_keyword_tag_offset([
        'id' => $id,
    ]);

    include_once "$fnsDir/Paging/limit.php";
    $limit = \Paging\limit();

    include_once "$fnsDir/BarChartBars/searchPageOnBarChart.php";
    $bars = \BarChartBars\searchPageOnBarChart(
        $mysqli, $id, $keyword, $offset, $limit, $total);

    include_once "$fnsDir/Form/hidden.php";
    include_once "$fnsDir/SearchForm/content.php";
    $formContent = \Form\hidden('id', $id)
        .\SearchForm\content($keyword, 'Search bars...', "../?id=$id");

    include_once "$fnsDir/SearchForm/create.php";
    $items = [\SearchForm\create('./', $formContent)];

    $params = [
        'id' => $id,
        'keyword' => $keyword,
    ];

    include_once "$fnsDir/check_offset_overflow.php";
    check_offset_overflow($offset, $limit, $total, $params);

    include_once __DIR__.'/../render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/renderBars.php';
    renderBars($bars, $items, $keyword);

    include_once __DIR__.'/../render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    unset(
        $_SESSION['bar-charts/all-bars/new/errors'],
        $_SESSION['bar-charts/all-bars/new/values'],
        $_SESSION['bar-charts/all-bars/view/messages'],
        $_SESSION['bar-charts/view/messages']
    );

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteAllLink">'
            .\Page\imageLink('Delete All Bars',
                "../delete-all/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => "Bar Chart #$id",
                'href' => "../../view/?id=$id#all-bars",
            ],
        ],
        'All Bars',
        \Page\sessionMessages('bar-charts/all-bars/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteLink),
        \Page\newItemButton("../new/$escapedItemQuery", 'Bar')
    );

}
