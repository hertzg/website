<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_received_task.php';
$receivedTask = require_received_task($mysqli, $user->id_users);

include_once '../../../fns/Users/Tasks/Received/delete.php';
Users\Tasks\Received\delete($mysqli, $receivedTask);

header('Content-Type: application/json');
echo 'true';
