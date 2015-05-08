<?php

namespace Users\BarCharts\Bars;

function index ($mysqli, $bar_chart) {

    if (!$bar_chart->num_bars) return [];

    include_once __DIR__.'/../../../BarChartBars/indexOnBarChart.php';
    return \BarChartBars\indexOnBarChart($mysqli, $bar_chart->id);

}
