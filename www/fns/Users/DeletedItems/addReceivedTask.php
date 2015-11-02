<?php

namespace Users\DeletedItems;

function addReceivedTask ($mysqli, $receivedTask, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $receivedTask->receiver_id_users, 'receivedTask', [
        'id' => $receivedTask->id,
        'text' => $receivedTask->text,
        'title' => $receivedTask->title,
        'deadline_time' => $receivedTask->deadline_time,
        'tags' => $receivedTask->tags,
        'top_priority' => $receivedTask->top_priority,
        'insert_time' => $receivedTask->insert_time,
        'sender_address' => $receivedTask->sender_address,
        'sender_id_users' => $receivedTask->sender_id_users,
        'sender_username' => $receivedTask->sender_username,
        'archived' => $receivedTask->archived,
    ], $apiKey);
}
