<?php

function to_client_json ($receivedTask) {
    $deadline_time = $receivedTask->deadline_time;
    return [
        'id' => (int)$receivedTask->id,
        'sender_username' => $receivedTask->sender_username,
        'text' => $receivedTask->text,
        'deadline_time' => $deadline_time === null ? null : (int)$deadline_time,
        'tags' => $receivedTask->tags,
        'top_priority' => (bool)$receivedTask->top_priority,
        'insert_time' => (int)$receivedTask->insert_time,
    ];
}
