<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_bar_charts');

include_once 'fns/require_bar.php';
$bar = require_bar($mysqli, $user->id_users);

include_once '../../../fns/Users/BarCharts/Bars/delete.php';
Users\BarCharts\Bars\delete($mysqli, $bar);

header('Content-Type: application/json');
echo 'true';
