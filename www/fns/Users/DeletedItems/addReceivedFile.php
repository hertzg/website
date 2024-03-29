<?php

namespace Users\DeletedItems;

function addReceivedFile ($mysqli, $receivedFile, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $receivedFile->receiver_id_users, 'receivedFile', [
        'id' => $receivedFile->id,
        'content_type' => $receivedFile->content_type,
        'media_type' => $receivedFile->media_type,
        'name' => $receivedFile->name,
        'size' => $receivedFile->size,
        'readable_size' => $receivedFile->readable_size,
        'hashes_computed' => $receivedFile->hashes_computed,
        'md5_sum' => $receivedFile->md5_sum,
        'sha256_sum' => $receivedFile->sha256_sum,
        'insert_time' => $receivedFile->insert_time,
        'sender_address' => $receivedFile->sender_address,
        'sender_id_users' => $receivedFile->sender_id_users,
        'sender_username' => $receivedFile->sender_username,
        'archived' => $receivedFile->archived,
    ], $apiKey);
}
