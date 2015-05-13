<?php

function require_bars ($mysqli, $base = '') {

    include_once __DIR__.'/../../fns/require_bar_chart.php';
    $values = require_bar_chart($mysqli, $base);
    list($bar_chart, $id, $user) = $values;

    if (!$bar_chart->num_bars) {
        unset($_SESSION['bar-charts/view/messages']);
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect("$base../view/?id=$id");
    }

    return $values;

}
