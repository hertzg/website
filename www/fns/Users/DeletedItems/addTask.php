<?php

namespace Users\DeletedItems;

function addTask ($mysqli, $task) {
    include_once __DIR__.'/add.php';
    add($mysqli, $task->id_users, 'task', [
        'id' => $task->id,
        'text' => $task->text,
        'deadline_time' => $task->deadline_time,
        'tags' => $task->tags,
        'top_priority' => $task->top_priority,
        'insert_time' => $task->insert_time,
        'update_time' => $task->update_time,
    ]);
}
