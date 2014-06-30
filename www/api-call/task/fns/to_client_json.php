<?php

function to_client_json ($task) {
    $deadline_time = $task->deadline_time;
    return [
        'id' => (int)$task->id_tasks,
        'text' => $task->text,
        'deadline_time' => $deadline_time === null ? null : (int)$deadline_time,
        'tags' => $task->tags,
        'top_priority' => (bool)$task->top_priority,
        'insert_time' => (int)$task->insert_time,
        'update_time' => (int)$task->update_time,
    ];
}
