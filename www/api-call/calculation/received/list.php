<?php

include_once '../../fns/require_api_key.php';
require_api_key('can_read_calculations', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Calculations/Received/index.php';
$receivedCalculations = Users\Calculations\Received\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $receivedCalculations));