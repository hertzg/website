<?php

include_once '../../fns/require_api_key.php';
require_api_key('barChart/bar/edit',
    'can_write_bar_charts', $apiKey, $user, $mysqli);

include_once 'fns/require_bar.php';
$bar = require_bar($mysqli, $user->id_users);

include_once 'fns/require_bar_params.php';
require_bar_params($value, $label);

include_once '../../../fns/Users/BarCharts/Bars/edit.php';
Users\BarCharts\Bars\edit($mysqli, $bar, $value, $label, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
