<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_events');

include_once 'fns/require_event.php';
$event = require_event($mysqli, $user->id_users);

include_once '../../fns/Users/Events/delete.php';
Users\Events\delete($mysqli, $user, $event);

header('Content-Type: application/json');
echo 'true';
