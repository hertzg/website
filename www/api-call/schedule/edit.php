<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_schedules');

include_once 'fns/require_schedule.php';
$schedule = require_schedule($mysqli, $user);

include_once 'fns/request_schedule_params.php';
list($text, $interval, $offset, $tags, $tag_names) = request_schedule_params();

include_once '../../fns/Users/Schedules/edit.php';
Users\Schedules\edit($mysqli, $user, $schedule,
    $text, $interval, $offset, $tags, $tag_names, $apiKey);

header('Content-Type: application/json');
echo 'true';
