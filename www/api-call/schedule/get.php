<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('schedule/get', 'can_read_schedules', $apiKey, $user, $mysqli);

include_once 'fns/require_schedule.php';
$schedule = require_schedule($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($schedule));
