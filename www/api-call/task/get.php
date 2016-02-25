<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('task/get', 'can_read_tasks', $apiKey, $user, $mysqli);

include_once 'fns/require_task.php';
$task = require_task($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(to_client_json($task));
