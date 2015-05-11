<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_bar_charts');

include_once 'fns/require_bar.php';
$bar = require_bar($mysqli, $user->id_users);

include_once 'fns/request_bar_params.php';
list($value, $label) = request_bar_params($user);

include_once '../../../fns/Users/BarCharts/Bars/edit.php';
Users\BarCharts\Bars\edit($mysqli, $bar->id, $value, $label, $apiKey);

header('Content-Type: application/json');
echo 'true';
