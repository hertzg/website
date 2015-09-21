<?php

namespace Users\BarCharts;

function editOrderBy ($mysqli, $id, $bar_charts_order_by) {
    $sql = "update users set bar_charts_order_by = '$bar_charts_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
