<?php

function to_client_json ($receivedFile) {
    return [
        'id' => (int)$receivedFile->id,
        'sender_username' => $receivedFile->sender_username,
        'name' => $receivedFile->name,
        'size' => (int)$receivedFile->size,
        'insert_time' => (int)$receivedFile->insert_time,
    ];
}
