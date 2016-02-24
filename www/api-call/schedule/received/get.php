<?php

include_once '../../fns/require_api_key.php';
require_api_key('schedule/received/get',
    'can_read_schedules', $apiKey, $user, $mysqli);

include_once 'fns/require_received_schedule.php';
$receivedSchedule = require_received_schedule($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($receivedSchedule));
