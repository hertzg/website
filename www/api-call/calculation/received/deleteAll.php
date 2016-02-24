<?php

include_once '../../fns/require_api_key.php';
require_api_key('calculation/received/deleteAll',
    'can_write_calculations', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Calculations/Received/deleteAll.php';
Users\Calculations\Received\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
