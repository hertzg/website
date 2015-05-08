<?php

namespace BarCharts;

function removeBar ($mysqli, $id) {
    $sql = "update bar_charts set num_bars = num_bars - 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
