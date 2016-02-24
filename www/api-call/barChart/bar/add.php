<?php

include_once '../../fns/require_api_key.php';
require_api_key('barChart/bar/add',
    'can_write_bar_charts', $apiKey, $user, $mysqli);

include_once '../fns/require_bar_chart.php';
$bar_chart = require_bar_chart($mysqli, $user);

include_once 'fns/require_bar_params.php';
require_bar_params($value, $label);

include_once '../../../fns/Users/BarCharts/Bars/add.php';
$id = Users\BarCharts\Bars\add($mysqli,
    $bar_chart, $value, $label, $apiKey);

header('Content-Type: application/json');
echo $id;
