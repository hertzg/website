<?php

include_once '../fns/require_api_key.php';
require_api_key('task/deleteAll', 'can_write_tasks', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Tasks/deleteAll.php';
Users\Tasks\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
