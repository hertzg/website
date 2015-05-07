<?php

namespace BarChartBars;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from bar_chart_bars where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
