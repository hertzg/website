<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_tasks');

include_once '../../../fns/Users/Tasks/Received/deleteAll.php';
Users\Tasks\Received\deleteAll($mysqli, $user->id_users);

header('Content-Type: application/json');
echo 'true';
