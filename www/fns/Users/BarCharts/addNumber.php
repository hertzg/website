<?php

namespace Users\BarCharts;

function addNumber ($mysqli, $id_users, $num_bar_charts) {
    $sql = "update users set num_bar_charts = num_bar_charts + $num_bar_charts"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
