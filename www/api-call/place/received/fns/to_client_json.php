<?php

function to_client_json ($receivedPlace) {
    return [
        'id' => (int)$receivedPlace->id,
        'sender_username' => $receivedPlace->sender_username,
        'latitude' => (float)$receivedPlace->latitude,
        'longitude' => (float)$receivedPlace->longitude,
        'name' => $receivedPlace->name,
        'tags' => $receivedPlace->tags,
        'insert_time' => (int)$receivedPlace->insert_time,
    ];
}
