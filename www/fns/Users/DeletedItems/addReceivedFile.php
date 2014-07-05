<?php

namespace Users\DeletedItems;

function addReceivedFile ($mysqli, $receivedFile) {
    include_once __DIR__.'/add.php';
    add($mysqli, $receivedFile->receiver_id_users, 'receivedFile', [
        'id' => $receivedFile->id,
        'content_type' => $receivedFile->content_type,
        'media_type' => $receivedFile->media_type,
        'name' => $receivedFile->name,
        'size' => $receivedFile->size,
        'insert_time' => $receivedFile->insert_time,
        'sender_id_users' => $receivedFile->sender_id_users,
        'sender_username' => $receivedFile->sender_username,
        'archived' => $receivedFile->archived,
    ]);
}
