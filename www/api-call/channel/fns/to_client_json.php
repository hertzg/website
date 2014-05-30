<?php

function to_client_json ($channel) {
    return [
        'id' => (int)$channel->id,
        'channel_name' => $channel->channel_name,
        'public' => (bool)$channel->public,
        'receive_notifications' => (bool)$channel->receive_notifications,
        'insert_time' => (int)$channel->insert_time,
        'update_time' => (int)$channel->update_time,
    ];
}
