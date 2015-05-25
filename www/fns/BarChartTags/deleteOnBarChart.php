<?php

namespace BarChartTags;

function deleteOnBarChart ($mysqli, $id_bar_charts) {
    $sql = "delete from bar_chart_tags where id_bar_charts = $id_bar_charts";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
