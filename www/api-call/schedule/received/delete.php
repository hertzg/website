<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('schedule/received/delete',
    'can_write_schedules', $apiKey, $user, $mysqli);

include_once 'fns/require_received_schedule.php';
$receivedSchedule = require_received_schedule($mysqli, $user);

include_once '../../../fns/Users/Schedules/Received/delete.php';
Users\Schedules\Received\delete($mysqli, $receivedSchedule, $apiKey);

header('Content-Type: application/json');
echo 'true';
