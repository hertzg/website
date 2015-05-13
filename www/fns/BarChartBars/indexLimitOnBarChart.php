<?php

namespace BarChartBars;

function indexLimitOnBarChart ($mysqli, $id_bar_charts, $limit) {
    $sql = "select * from bar_chart_bars where id_bar_charts = $id_bar_charts"
        ." order by label, insert_time limit $limit";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
