<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('task/received/importCopy',
    'can_write_tasks', $apiKey, $user, $mysqli);

include_once 'fns/require_received_task.php';
$receivedTask = require_received_task($mysqli, $user);

include_once '../../../fns/Users/Tasks/Received/importCopy.php';
$id = Users\Tasks\Received\importCopy($mysqli, $user, $receivedTask, $apiKey);

header('Content-Type: application/json');
echo $id;
