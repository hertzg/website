<?php

namespace BarCharts;

function removeAllBars ($mysqli, $id) {
    $sql = "update bar_charts set num_bars = 0 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
