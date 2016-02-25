<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('schedule/received/list',
    'can_read_schedules', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Schedules/Received/index.php';
$receivedSchedules = Users\Schedules\Received\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $receivedSchedules));
