<?php

function to_client_json ($subscribedChannel) {
    $receive_notifications = (bool)$subscribedChannel->receive_notifications;
    return [
        'id' => (int)$subscribedChannel->id,
        'channel_name' => $subscribedChannel->channel_name,
        'channel_public' => (bool)$subscribedChannel->channel_public,
        'receive_notifications' => $receive_notifications,
    ];
}
