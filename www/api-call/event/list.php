<?php

include_once '../fns/require_api_key.php';
require_api_key('event/list', 'can_read_events', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Events/index.php';
$events = Users\Events\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $events));
