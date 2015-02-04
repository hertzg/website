<?php

function to_client_json ($notification) {
    return [
        'id' => $notification->id,
        'text' => $notification->text,
        'channel_name' => $notification->channel_name,
        'insert_time' => (int)$notification->insert_time,
    ];
}
