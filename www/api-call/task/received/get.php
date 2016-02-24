<?php

include_once '../../fns/require_api_key.php';
require_api_key('task/received/get', 'can_read_tasks', $apiKey, $user, $mysqli);

include_once 'fns/require_received_task.php';
$receivedTask = require_received_task($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($receivedTask));
