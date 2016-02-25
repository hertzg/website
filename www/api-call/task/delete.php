<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('task/delete', 'can_write_tasks', $apiKey, $user, $mysqli);

include_once 'fns/require_task.php';
$task = require_task($mysqli, $user);

include_once '../../fns/Users/Tasks/delete.php';
Users\Tasks\delete($mysqli, $user, $task, $apiKey);

header('Content-Type: application/json');
echo 'true';
