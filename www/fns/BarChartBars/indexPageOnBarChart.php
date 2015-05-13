<?php

namespace BarChartBars;

function indexPageOnBarChart ($mysqli,
    $id_bar_charts, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    $fromWhere = "from bar_chart_bars where id_bar_charts = $id_bar_charts";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by label, insert_time"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
