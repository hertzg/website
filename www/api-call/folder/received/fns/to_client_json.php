<?php

function to_client_json ($receivedFolder) {
    return [
        'id' => (int)$receivedFolder->id,
        'sender_username' => $receivedFolder->sender_username,
        'name' => $receivedFolder->name,
        'insert_time' => (int)$receivedFolder->insert_time,
    ];
}
