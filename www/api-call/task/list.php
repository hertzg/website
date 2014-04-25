<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once '../../fns/Tasks/indexOnUser.php';
$tasks = Tasks\indexOnUser($mysqli, $id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($task) {
        return [
            'id' => (int)$task->id_tasks,
            'text' => $task->text,
            'tags' => $task->tags,
            'top_priority' => (bool)$task->top_priority,
            'insert_time' => (int)$task->insert_time,
            'update_time' => (int)$task->update_time,
        ];
    }, $tasks)
);
