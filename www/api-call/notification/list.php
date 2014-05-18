<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once '../../fns/Notifications/indexOnUser.php';
$notifications = Notifications\indexOnUser($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($notification) {
        return [
            'id' => $notification->id,
            'notification_text' => $notification->notification_text,
            'channel_name' => $notification->channel_name,
            'insert_time' => (int)$notification->insert_time,
        ];
    }, $notifications)
);
