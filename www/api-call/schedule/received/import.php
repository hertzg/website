<?php

include_once '../../fns/require_api_key.php';
require_api_key('schedule/received/import',
    'can_write_schedules', $apiKey, $user, $mysqli);

include_once 'fns/require_received_schedule.php';
$receivedSchedule = require_received_schedule($mysqli, $user);

include_once '../../../fns/Users/Schedules/Received/import.php';
$id = Users\Schedules\Received\import($mysqli,
    $user, $receivedSchedule, $apiKey);

header('Content-Type: application/json');
echo $id;
