<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('calculation/delete',
    'can_write_calculations', $apiKey, $user, $mysqli);

include_once 'fns/require_calculation.php';
$calculation = require_calculation($mysqli, $user);

include_once '../../fns/Users/Calculations/delete.php';
Users\Calculations\delete($mysqli, $user, $calculation, $apiKey);

header('Content-Type: application/json');
echo 'true';
