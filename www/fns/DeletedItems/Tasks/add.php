<?php

namespace DeletedItems\Tasks;

function add ($mysqli, $task) {
    include_once __DIR__.'/../add.php';
    \DeletedItems\add($mysqli, $task->id_users, 'task', [
        'id' => $task->id_tasks,
        'text' => $task->text,
        'tags' => $task->tags,
        'top_priority' => $task->top_priority,
        'insert_time' => $task->insert_time,
        'update_time' => $task->update_time,
    ]);
}
