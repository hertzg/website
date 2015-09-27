<?php

function to_client_json ($user) {
    return [
        'id' => (int)$user->id_users,
        'username' => $user->username,
        'storage_used' => (int)$user->storage_used,
        'insert_time' => (int)$user->insert_time,
        'access_time' => (int)$user->access_time,
    ];
}
