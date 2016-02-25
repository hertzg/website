<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('calculation/get',
    'can_read_calculations', $apiKey, $user, $mysqli);

include_once 'fns/require_calculation.php';
$calculation = require_calculation($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($calculation));
