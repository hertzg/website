<?php

include_once '../fns/require_api_key.php';
require_api_key('event/get', 'can_read_events', $apiKey, $user, $mysqli);

include_once 'fns/require_event.php';
$event = require_event($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($event));
