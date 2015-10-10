<?php

namespace Users\BarCharts;

function edit ($mysqli, $bar_chart, $name, $tags,
    $tag_names, &$changed, $updateApiKey = null) {

    if ($bar_chart->name === $name && $bar_chart->tags === $tags) return;

    $changed = true;
    $id = $bar_chart->id;
    $fnsDir = __DIR__.'/../..';

    $update_time = time();

    include_once "$fnsDir/BarCharts/edit.php";
    \BarCharts\edit($mysqli, $id, $name, $tags,
        $tag_names, $update_time, $updateApiKey);

    if ($bar_chart->num_tags) {
        include_once "$fnsDir/BarChartTags/deleteOnBarChart.php";
        \BarChartTags\deleteOnBarChart($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/BarChartTags/add.php";
        \BarChartTags\add($mysqli, $bar_chart->id_users, $id,
            $tag_names, $name, $tags, $bar_chart->insert_time, $update_time);
    }

}
