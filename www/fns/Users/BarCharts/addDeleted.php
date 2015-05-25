<?php

namespace Users\BarCharts;

function addDeleted ($mysqli, $id_users, $data) {

    $fnsDir = __DIR__.'/../..';
    $id = $data->id;
    $name = $data->name;
    $tags = $data->tags;
    $num_bars = $data->num_bars;

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/BarCharts/addDeleted.php";
    \BarCharts\addDeleted($mysqli, $id, $id_users, $name, $tags, $tag_names,
        $num_bars, $data->insert_time, $data->update_time, $data->revision);

    if ($num_bars) {
        include_once "$fnsDir/BarChartBars/setDeletedOnBarChart.php";
        \BarChartBars\setDeletedOnBarChart($mysqli, $id, false);
    }

    if ($tag_names) {
        include_once "$fnsDir/BarChartTags/add.php";
        \BarChartTags\add($mysqli, $id_users, $id, $tag_names, $name, $tags);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
