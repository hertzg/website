<?php

include_once '../fns/require_api_key.php';
require_api_key('task/list', 'can_read_tasks', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Tasks/index.php';
$tasks = Users\Tasks\index($mysqli, $user);

include_once 'fns/to_client_json.php';
header('Content-Type: application/json');
echo json_encode(array_map('to_client_json', $tasks));
