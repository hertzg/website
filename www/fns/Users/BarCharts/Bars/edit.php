<?php

namespace Users\BarCharts\Bars;

function edit ($mysqli, $id, $value, $label, $updateApiKey = null) {

    include_once __DIR__.'/../../../BarChartBars/edit.php';
    \BarChartBars\edit($mysqli, $id, $value, $label, $updateApiKey);

}
