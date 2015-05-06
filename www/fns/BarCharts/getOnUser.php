<?php

namespace BarCharts;

function getOnUser ($mysqli, $id_users, $id) {
    include_once __DIR__.'/get.php';
    $bar_chart = get($mysqli, $id);
    if ($bar_chart && $bar_chart->id_users == $id_users) return $bar_chart;
}
