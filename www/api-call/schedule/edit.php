<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_schedule.php';
$schedule = require_schedule($mysqli, $user->id_users);

include_once 'fns/request_schedule_params.php';
list($text, $interval, $offset) = request_schedule_params();

include_once '../../fns/Users/Schedules/edit.php';
Users\Schedules\edit($mysqli, $user, $schedule, $text, $interval, $offset);

header('Content-Type: application/json');
echo 'true';
