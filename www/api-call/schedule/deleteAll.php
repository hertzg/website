<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_schedules');

include_once '../../fns/Users/Schedules/deleteAll.php';
Users\Schedules\deleteAll($mysqli, $user);

header('Content-Type: application/json');
echo 'true';
