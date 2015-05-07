<?php

namespace BarChartBars;

function delete ($mysqli, $id) {
    $sql = "delete from bar_chart_bars where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
