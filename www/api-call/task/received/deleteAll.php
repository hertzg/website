<?php

include_once '../../fns/require_api_key.php';
require_api_key('can_write_tasks', $apiKey, $user, $mysqli);

include_once '../../../fns/Users/Tasks/Received/deleteAll.php';
Users\Tasks\Received\deleteAll($mysqli, $user, $apiKey);

header('Content-Type: application/json');
echo 'true';
