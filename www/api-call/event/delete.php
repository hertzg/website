<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('event/delete', 'can_write_events', $apiKey, $user, $mysqli);

include_once 'fns/require_event.php';
$event = require_event($mysqli, $user);

include_once '../../fns/Users/Events/delete.php';
Users\Events\delete($mysqli, $user, $event);

header('Content-Type: application/json');
echo 'true';
