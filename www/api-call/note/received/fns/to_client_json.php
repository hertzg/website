<?php

function to_client_json ($receivedNote) {
    return [
        'id' => (int)$receivedNote->id,
        'sender_username' => $receivedNote->sender_username,
        'text' => $receivedNote->text,
        'tags' => $receivedNote->tags,
        'insert_time' => (int)$receivedNote->insert_time,
    ];
}
