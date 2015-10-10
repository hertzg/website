<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_events');

include_once 'fns/require_event.php';
$event = require_event($mysqli, $user);

include_once 'fns/request_event_params.php';
list($event_time, $text) = request_event_params();

include_once '../../fns/Users/Events/edit.php';
Users\Events\edit($mysqli, $user, $event,
    $text, $event_time, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
