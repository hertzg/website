<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_schedules');

include_once 'fns/require_schedule.php';
$schedule = require_schedule($mysqli, $user->id_users);

include_once '../../fns/Users/Schedules/delete.php';
Users\Schedules\delete($mysqli, $user, $schedule);

header('Content-Type: application/json');
echo 'true';
