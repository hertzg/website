<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_events');

include_once '../../fns/Users/Events/deleteAll.php';
Users\Events\deleteAll($mysqli, $user);

header('Content-Type: application/json');
echo 'true';
