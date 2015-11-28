<?php

namespace BarCharts;

function updateNumbers ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/mysqli_query_object.php";
    $bar_charts = mysqli_query_object($mysqli, 'select * from bar_charts');

    if (!$bar_charts) return;

    include_once __DIR__.'/editNumbers.php';
    include_once "$fnsDir/BarChartBars/countOnBarChart.php";
    foreach ($bar_charts as $bar_chart) {
        $id = $bar_chart->id;
        $num_bars = \BarChartBars\countOnBarChart($mysqli, $id);
        editNumbers($mysqli, $id, $num_bars);
    }

}
