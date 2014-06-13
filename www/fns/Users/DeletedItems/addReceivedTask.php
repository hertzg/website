<?php

namespace Users\DeletedItems;

function addReceivedTask ($mysqli, $receivedTask) {
    $id_users = $receivedTask->receiver_id_users;
    include_once __DIR__.'/../../DeletedItems/add.php';
    \DeletedItems\add($mysqli, $id_users, 'receivedTask', [
        'id' => $receivedTask->id_tasks,
        'text' => $receivedTask->text,
        'tags' => $receivedTask->tags,
        'top_priority' => $receivedTask->top_priority,
        'insert_time' => $receivedTask->insert_time,
        'sender_id_users' => $receivedTask->sender_id_users,
        'sender_username' => $receivedTask->sender_username,
        'archived' => $receivedTask->archived,
    ]);
}
