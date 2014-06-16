<?php

namespace Users\DeletedItems;

function addReceivedFile ($mysqli, $receivedFile) {
    $id_users = $receivedFile->receiver_id_users;
    include_once __DIR__.'/../../DeletedItems/add.php';
    \DeletedItems\add($mysqli, $id_users, 'receivedFile', [
        'id' => $receivedFile->id,
        'name' => $receivedFile->name,
        'size' => $receivedFile->size,
        'insert_time' => $receivedFile->insert_time,
        'sender_id_users' => $receivedFile->sender_id_users,
        'sender_username' => $receivedFile->sender_username,
        'archived' => $receivedFile->archived,
    ]);
}
