<?php

namespace ViewPage;

function barsPanel ($mysqli, $bar_chart, &$scripts) {

    $id = $bar_chart->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/newItemButton.php";
    $newItemButton = \Page\newItemButton(
        '../new-bar/'.\ItemList\escapedItemQuery($id),
        'Bar', !$bar_chart->num_bars);

    $num_bars = $bar_chart->num_bars;
    if ($num_bars) {

        $limit = 5;

        if ($num_bars > $limit) {

            include_once "$fnsDir/SearchForm/emptyContent.php";
            $content = "<input type=\"hidden\" name=\"id\" value=\"$id\" />"
                .\SearchForm\emptyContent('Search bars...');

            include_once "$fnsDir/SearchForm/create.php";
            $items[] = \SearchForm\create(
                '../all-bars/search/', $content);

            include_once "$fnsDir/compressed_js_script.php";
            $scripts .= compressed_js_script('searchForm', '../../');

        }

        include_once "$fnsDir/BarChartBars/indexLimitOnBarChart.php";
        $bars = \BarChartBars\indexLimitOnBarChart($mysqli, $id, $limit);

        include_once __DIR__.'/../render_bars.php';
        render_bars($bars, $items);

        if ($num_bars > $limit) {
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            $items[] = \Page\imageArrowLinkWithDescription('All Bars',
                "$num_bars total.", "../all-bars/?id=$id",
                'bars', ['id' => 'all-bars']);
        }

        $content = join('<div class="hr"></div>', $items);

    } else {
        include_once "$fnsDir/Page/info.php";
        $content = \Page\info('No bars');
    }

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Bars', $content, $newItemButton);

}
