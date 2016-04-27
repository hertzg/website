<?php

namespace BarChartBars;

function searchPageOnBarChart ($mysqli, $id_bar_charts,
    $includes, $excludes, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $fromWhere = "from bar_chart_bars where id_bar_charts = $id_bar_charts";
    foreach ($includes as $include) {
        $include = $mysqli->real_escape_string(escape_like($include));
        $fromWhere .= " and label like '%$include%'";
    }
    foreach ($excludes as $exclude) {
        $exclude = $mysqli->real_escape_string(escape_like($exclude));
        $fromWhere .= " and label not like '%$exclude%'";
    }

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by label, insert_time"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
