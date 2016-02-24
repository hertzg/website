<?php

include_once '../fns/require_api_key.php';
require_api_key('event/add', 'can_write_events', $apiKey, $user, $mysqli);

include_once 'fns/require_event_params.php';
require_event_params($event_time, $start_hour, $start_minute, $text);

include_once '../../fns/Users/Events/add.php';
$id = Users\Events\add($mysqli, $user, $text,
    $event_time, $start_hour, $start_minute, $apiKey);

header('Content-Type: application/json');
echo $id;
