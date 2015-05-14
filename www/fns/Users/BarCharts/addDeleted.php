<?php

namespace Users\BarCharts;

function addDeleted ($mysqli, $id_users, $data) {

    $fnsDir = __DIR__.'/../..';
    $id = $data->id;
    $num_bars = $data->num_bars;

    include_once "$fnsDir/BarCharts/addDeleted.php";
    \BarCharts\addDeleted($mysqli, $id, $id_users, $data->name,
        $num_bars, $data->insert_time, $data->update_time, $data->revision);

    if ($num_bars) {
        include_once "$fnsDir/BarChartBars/setDeletedOnBarChart.php";
        \BarChartBars\setDeletedOnBarChart($mysqli, $id, false);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
