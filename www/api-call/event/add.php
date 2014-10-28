<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_events');

include_once 'fns/request_event_params.php';
list($text, $event_time) = request_event_params();

include_once '../../fns/Users/Events/add.php';
$id = Users\Events\add($mysqli, $user, $text, $event_time, $apiKey);

header('Content-Type: application/json');
echo $id;
