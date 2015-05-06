<?php

namespace BarCharts;

function delete ($mysqli, $id) {
    $sql = "delete from bar_charts where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
