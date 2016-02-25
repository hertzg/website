<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('schedule/deleteAll',
    'can_write_schedules', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Schedules/deleteAll.php';
Users\Schedules\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
