<?php

namespace BarChartBars;

function countOnBarChart ($mysqli, $id_bar_charts) {
    $sql = 'select count(*) value from bar_chart_bars'
        ." where id_bar_charts = $id_bar_charts";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
