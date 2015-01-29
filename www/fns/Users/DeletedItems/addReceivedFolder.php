<?php

namespace Users\DeletedItems;

function addReceivedFolder ($mysqli, $receivedFolder, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $receivedFolder->receiver_id_users, 'receivedFolder', [
        'id' => $receivedFolder->id,
        'name' => $receivedFolder->name,
        'insert_time' => $receivedFolder->insert_time,
        'sender_id_users' => $receivedFolder->sender_id_users,
        'sender_username' => $receivedFolder->sender_username,
        'archived' => $receivedFolder->archived,
    ], $apiKey);
}
