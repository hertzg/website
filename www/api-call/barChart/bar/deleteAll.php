<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('barChart/bar/deleteAll',
    'can_write_bar_charts', $apiKey, $user, $mysqli);

include_once '../fns/require_bar_chart.php';
$bar_chart = require_bar_chart($mysqli, $user);

include_once '../../../fns/Users/BarCharts/Bars/deleteAll.php';
Users\BarCharts\Bars\deleteAll($mysqli, $bar_chart);

header('Content-Type: application/json');
echo 'true';
