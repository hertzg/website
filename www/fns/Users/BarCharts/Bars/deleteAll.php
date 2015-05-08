<?php

namespace Users\BarCharts\Bars;

function deleteAll ($mysqli, $bar_chart) {

    if (!$bar_chart->num_bars) return;

    $id = $bar_chart->id;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/BarChartBars/deleteOnBarChart.php";
    \BarChartBars\deleteOnBarChart($mysqli, $id);

    include_once "$fnsDir/BarCharts/removeAllBars.php";
    \BarCharts\removeAllBars($mysqli, $id);

}
