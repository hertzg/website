<?php

include_once '../fns/require_api_key.php';
require_api_key('barChart/list',
    'can_read_bar_charts', $apiKey, $user, $mysqli);

include_once '../../fns/Users/BarCharts/index.php';
$bar_charts = Users\BarCharts\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $bar_charts));
