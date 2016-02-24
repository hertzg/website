<?php

include_once '../../fns/require_api_key.php';
require_api_key('schedule/received/deleteAll',
    'can_write_schedules', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Schedules/Received/deleteAll.php';
Users\Schedules\Received\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
