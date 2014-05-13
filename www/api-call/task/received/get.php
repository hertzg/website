<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_received_task.php';
$receivedTask = require_received_task($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode([
    'id' => (int)$receivedTask->id,
    'sender_username' => $receivedTask->sender_username,
    'text' => $receivedTask->text,
    'top_priority' => (bool)$receivedTask->top_priority,
    'tags' => $receivedTask->tags,
    'insert_time' => (int)$receivedTask->insert_time,
]);
