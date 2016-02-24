<?php

include_once '../../fns/require_api_key.php';
require_api_key('calculation/received/delete',
    'can_write_calculations', $apiKey, $user, $mysqli);

include_once 'fns/require_received_calculation.php';
$receivedCalculation = require_received_calculation($mysqli, $user);

include_once '../../../fns/Users/Calculations/Received/delete.php';
Users\Calculations\Received\delete($mysqli, $receivedCalculation, $apiKey);

header('Content-Type: application/json');
echo 'true';
