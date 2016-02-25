<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('event/edit', 'can_write_events', $apiKey, $user, $mysqli);

include_once 'fns/require_event.php';
$event = require_event($mysqli, $user);

include_once 'fns/require_event_params.php';
require_event_params($event_time, $start_hour, $start_minute, $text);

include_once '../../fns/Users/Events/edit.php';
Users\Events\edit($mysqli, $user, $event, $text,
    $event_time, $start_hour, $start_minute, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
