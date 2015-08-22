<?php

function to_client_json ($notification) {
    return [
        'id' => (int)$notification->id,
        'channel_name' => $notification->channel_name,
        'text' => $notification->text,
        'insert_time' => (int)$notification->insert_time,
    ];
}
