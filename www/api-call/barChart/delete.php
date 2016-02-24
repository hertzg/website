<?php

include_once '../fns/require_api_key.php';
require_api_key('barChart/delete',
    'can_write_bar_charts', $apiKey, $user, $mysqli);

include_once 'fns/require_bar_chart.php';
$bar_chart = require_bar_chart($mysqli, $user);

include_once '../../fns/Users/BarCharts/delete.php';
Users\BarCharts\delete($mysqli, $bar_chart, $apiKey);

header('Content-Type: application/json');
echo 'true';
