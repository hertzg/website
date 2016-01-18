<?php

namespace Users\BarCharts;

function delete ($mysqli, $bar_chart, $apiKey = null) {

    $id = $bar_chart->id;
    $id_users = $bar_chart->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/BarCharts/delete.php";
    \BarCharts\delete($mysqli, $id);

    if ($bar_chart->num_bars) {
        include_once "$fnsDir/BarChartBars/setDeletedOnBarChart.php";
        \BarChartBars\setDeletedOnBarChart($mysqli, $id, true);
    }

    if ($bar_chart->num_tags) {
        include_once "$fnsDir/BarChartTags/deleteOnBarChart.php";
        \BarChartTags\deleteOnBarChart($mysqli, $id);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    include_once __DIR__.'/../DeletedItems/addBarChart.php';
    \Users\DeletedItems\addBarChart($mysqli, $bar_chart, $apiKey);

}
