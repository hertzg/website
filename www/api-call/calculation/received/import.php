<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('calculation/received/import',
    'can_write_calculations', $apiKey, $user, $mysqli);

include_once 'fns/require_received_calculation.php';
$receivedCalculation = require_received_calculation($mysqli, $user);

include_once '../../../fns/Users/Calculations/Received/import.php';
$id = Users\Calculations\Received\import(
    $mysqli, $receivedCalculation, [], $apiKey);

header('Content-Type: application/json');
echo $id;
