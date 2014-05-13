<?php

function to_client_json ($receivedTask) {
    return [
        'id' => (int)$receivedTask->id,
        'sender_username' => $receivedTask->sender_username,
        'text' => $receivedTask->text,
        'top_priority' => (bool)$receivedTask->top_priority,
        'tags' => $receivedTask->tags,
        'insert_time' => (int)$receivedTask->insert_time,
    ];
}
