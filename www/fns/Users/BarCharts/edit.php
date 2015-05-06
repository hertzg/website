<?php

namespace Users\BarCharts;

function edit ($mysqli, $id, $name, $updateApiKey = null) {
    include_once __DIR__.'/../../BarCharts/edit.php';
    \BarCharts\edit($mysqli, $id, $name, $updateApiKey);
}
