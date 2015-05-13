<?php

namespace BarChartBars;

function indexOnBarChart ($mysqli, $id_bar_charts) {
    $sql = 'select * from bar_chart_bars'
        ." where id_bar_charts = $id_bar_charts"
        .' order by label, insert_time';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
