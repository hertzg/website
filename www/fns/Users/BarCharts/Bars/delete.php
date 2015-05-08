s<?php

namespace Users\BarCharts\Bars;

function delete ($mysqli, $bar) {

    $fnsDir = __DIR__.'/../../../';

    include_once "$fnsDir/BarChartBars/delete.php";
    \BarChartBars\delete($mysqli, $bar->id);

    include_once "$fnsDir/BarCharts/removeBar.php";
    \BarCharts\removeBar($mysqli, $bar->id_bar_charts);

}
