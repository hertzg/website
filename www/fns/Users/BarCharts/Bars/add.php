<?php

namespace Users\BarCharts\Bars;

function add ($mysqli, $bar_chart, $value, $label, $insertApiKey = null) {

    $id_bar_charts = $bar_chart->id;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/BarChartBars/add.php";
    $id = \BarChartBars\add($mysqli, $bar_chart->id_users,
        $id_bar_charts, $value, $label, $insertApiKey);

    include_once "$fnsDir/BarCharts/addBar.php";
    \BarCharts\addBar($mysqli, $id_bar_charts);

    return $id;

}
