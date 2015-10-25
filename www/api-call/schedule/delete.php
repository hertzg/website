<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_schedules', $apiKey, $user, $mysqli);

include_once 'fns/require_schedule.php';
$schedule = require_schedule($mysqli, $user);

include_once '../../fns/Users/Schedules/delete.php';
Users\Schedules\delete($mysqli, $user, $schedule);

header('Content-Type: application/json');
echo 'true';
