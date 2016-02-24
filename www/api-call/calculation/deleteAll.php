<?php

include_once '../fns/require_api_key.php';
require_api_key('calculation/deleteAll',
    'can_write_calculations', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Calculations/deleteAll.php';
Users\Calculations\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
