<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once '../../fns/Channels/indexOnUser.php';
$channels = Channels\indexOnUser($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($channel) {
        return [
            'id' => (int)$channel->id,
            'channel_name' => $channel->channel_name,
            'public' => (bool)$channel->public,
            'receive_notifications' => (bool)$channel->receive_notifications,
            'insert_time' => (int)$channel->insert_time,
            'update_time' => (int)$channel->update_time,
        ];
    }, $channels)
);
