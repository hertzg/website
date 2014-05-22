<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_event.php';
$event = require_event($mysqli, $id_users);

include_once 'fns/request_event_params.php';
list($text, $event_time) = request_event_params();

include_once '../../fns/Users/Events/edit.php';
Users\Events\edit($mysqli, $user, $event, $text, $event_time);

header('Content-Type: application/json');
echo 'true';
