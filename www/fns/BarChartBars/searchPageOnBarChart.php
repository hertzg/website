<?php

namespace BarChartBars;

function searchPageOnBarChart ($mysqli, $id_bar_charts,
    $keyword, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);

    $fromWhere = "from bar_chart_bars where id_bar_charts = $id_bar_charts"
        ." and label like '%$keyword%'";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by label, insert_time"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
