<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_bar_charts');

include_once '../fns/require_bar_chart.php';
$bar_chart = require_bar_chart($mysqli, $user);

include_once 'fns/request_bar_params.php';
list($value, $label) = request_bar_params();

include_once '../../../fns/Users/BarCharts/Bars/add.php';
$id = Users\BarCharts\Bars\add($mysqli,
    $bar_chart, $value, $label, $apiKey);

header('Content-Type: application/json');
echo $id;
