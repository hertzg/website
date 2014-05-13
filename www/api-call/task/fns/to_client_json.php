<?php

function to_client_json ($task) {
    return [
        'id' => (int)$task->id_tasks,
        'text' => $task->text,
        'tags' => $task->tags,
        'top_priority' => (bool)$task->top_priority,
        'insert_time' => (int)$task->insert_time,
        'update_time' => (int)$task->update_time,
    ];
}
