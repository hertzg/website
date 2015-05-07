<?php

namespace BarChartBars;

function setDeletedOnBarChart ($mysqli, $id_bar_charts, $deleted) {
    $deleted = $deleted ? '1' : '0';
    $sql = "update bar_chart_bars set deleted = $deleted"
        ." where id_bar_charts = $id_bar_charts";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
