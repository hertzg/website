<?php

include_once '../fns/require_api_key.php';
require_api_key('barChart/edit',
    'can_write_bar_charts', $apiKey, $user, $mysqli);

include_once 'fns/require_bar_chart.php';
$bar_chart = require_bar_chart($mysqli, $user);

include_once 'fns/require_bar_chart_params.php';
require_bar_chart_params($name, $tags, $tag_names);

include_once '../../fns/Users/BarCharts/edit.php';
Users\BarCharts\edit($mysqli, $bar_chart,
    $name, $tags, $tag_names, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
