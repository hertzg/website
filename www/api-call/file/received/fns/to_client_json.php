<?php

function to_client_json ($receivedFile) {
    return [
        'id' => (int)$receivedFile->id,
        'sender_username' => $receivedFile->sender_username,
        'name' => $receivedFile->name,
        'size' => (int)$receivedFile->size,
        'md5_sum' => $receivedFile->md5_sum,
        'sha256_sum' => $receivedFile->sha256_sum,
        'insert_time' => (int)$receivedFile->insert_time,
    ];
}
