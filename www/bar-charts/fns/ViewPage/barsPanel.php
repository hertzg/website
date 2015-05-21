<?php

namespace ViewPage;

function barsPanel ($mysqli, $bar_chart) {

    $id = $bar_chart->id;
    $fnsDir = __DIR__.'/../../../fns';

    $num_bars = $bar_chart->num_bars;
    if ($num_bars) {

        $limit = 5;

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

    include_once "$fnsDir/create_panel.php";
    return create_panel('Bars', $content);

}
