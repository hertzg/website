<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_read_notifications');

include_once '../../fns/Notifications/indexOnUser.php';
$notifications = Notifications\indexOnUser($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($notification) {
        return [
            'id' => $notification->id,
            'text' => $notification->text,
            'channel_name' => $notification->channel_name,
            'insert_time' => (int)$notification->insert_time,
        ];
    }, $notifications)
);
