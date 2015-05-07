<?php

namespace BarChartBars;

function setDeletedOnUser ($mysqli, $id_users) {
    $sql = "update bar_chart_bars set deleted = 1 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
