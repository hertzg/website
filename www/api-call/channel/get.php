<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_channel.php';
list($id, $channel) = require_channel($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode([
    'id' => (int)$id,
    'channel_name' => $channel->channel_name,
    'public' => (bool)$channel->public,
    'insert_time' => (int)$channel->insert_time,
    'update_time' => (int)$channel->update_time,
]);
