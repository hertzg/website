<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('event/deleteAll', 'can_write_events', $apiKey, $user, $mysqli);

include_once '../../fns/Users/Events/deleteAll.php';
Users\Events\deleteAll($mysqli, $user);

header('Content-Type: application/json');
echo 'true';
