<?php

function create_page ($mysqli, $user, $bar_chart, &$scripts, $base = '') {

    $id = $bar_chart->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', "$base../../");

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset("./?id=$id");

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once "$fnsDir/BarChartBars/indexPageOnBarChart.php";
    $bars = BarChartBars\indexPageOnBarChart(
        $mysqli, $id, $offset, $limit, $total);

    $items = [];

    $params = ['id' => $id];

    include_once __DIR__.'/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/render_bars.php';
    render_bars($bars, $items, $base);

    include_once __DIR__.'/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    unset(
        $_SESSION['bar-charts/all-bars/new/errors'],
        $_SESSION['bar-charts/all-bars/new/values'],
        $_SESSION['bar-charts/all-bars/view/messages'],
        $_SESSION['bar-charts/view/messages']
    );

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteAllLink">'
            .Page\imageLink('Delete All Bars',
                "{$base}delete-all/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => "Bar Chart #$id",
                'href' => "$base../view/?id=$id#all-bars",
            ],
        ],
        'All Bars',
        Page\sessionMessages('bar-charts/all-bars/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteLink),
        Page\newItemButton("{$base}new/$escapedItemQuery", 'Bar')
    );

}