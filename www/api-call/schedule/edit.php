<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('schedule/edit',
    'can_write_schedules', $apiKey, $user, $mysqli);

include_once 'fns/require_schedule.php';
$schedule = require_schedule($mysqli, $user);

include_once 'fns/require_schedule_params.php';
require_schedule_params($text, $interval, $offset, $tags, $tag_names);

include_once '../../fns/Users/Schedules/edit.php';
Users\Schedules\edit($mysqli, $user, $schedule, $text,
    $interval, $offset, $tags, $tag_names, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
