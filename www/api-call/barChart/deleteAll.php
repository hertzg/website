<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('barChart/deleteAll',
    'can_write_bar_charts', $apiKey, $user, $mysqli);

include_once '../../fns/Users/BarCharts/deleteAll.php';
Users\BarCharts\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
