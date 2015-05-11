<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_bar_charts');

include_once '../../fns/Users/BarCharts/deleteAll.php';
Users\BarCharts\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
