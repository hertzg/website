<?php

include_once '../fns/require_api_key.php';
require_api_key('barChart/get', 'can_read_bar_charts', $apiKey, $user, $mysqli);

include_once 'fns/require_bar_chart.php';
$bar_chart = require_bar_chart($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($bar_chart));
