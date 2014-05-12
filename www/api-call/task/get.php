<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_task.php';
$task = require_task($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode([
    'id' => (int)$task->id_tasks,
    'text' => $task->text,
    'tags' => $task->tags,
    'top_priority' => (bool)$task->top_priority,
    'insert_time' => (int)$task->insert_time,
    'update_time' => (int)$task->update_time,
]);
