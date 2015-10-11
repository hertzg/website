<?php

namespace Users\BarCharts\Bars;

function edit ($mysqli, $bar, $value,
    $label, &$changed, $updateApiKey = null) {

    if ((string)$bar->value === (string)$value &&
        $bar->label === $label) return;

    $changed = true;

    include_once __DIR__.'/../../../BarChartBars/edit.php';
    \BarChartBars\edit($mysqli, $bar->id, $value, $label, $updateApiKey);

}
