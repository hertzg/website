<?php

namespace BarCharts;

function editNumbers ($mysqli, $id, $num_bars) {
    $sql = "update bar_charts set num_bars = $num_bars where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
