<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_bar_charts');

include_once 'fns/require_bar_chart.php';
$bar_chart = require_bar_chart($mysqli, $user);

include_once 'fns/request_bar_chart_params.php';
list($name, $tags, $tag_names) = request_bar_chart_params($user);

include_once '../../fns/Users/BarCharts/edit.php';
Users\BarCharts\edit($mysqli, $bar_chart, $name, $tags, $tag_names, $apiKey);

header('Content-Type: application/json');
echo 'true';
