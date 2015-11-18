<?php

function to_client_json ($receivedPlace) {

    $sender_username = $receivedPlace->sender_username;
    $sender_address = $receivedPlace->sender_address;
    if ($sender_address !== null) $sender_username .= "@$sender_address";

    $altitude = $receivedPlace->altitude;

    return [
        'id' => (int)$receivedPlace->id,
        'sender_username' => $sender_username,
        'latitude' => (float)$receivedPlace->latitude,
        'longitude' => (float)$receivedPlace->longitude,
        'altitude' => $altitude === null ? null : (float)$altitude,
        'name' => $receivedPlace->name,
        'description' => $receivedPlace->description,
        'tags' => $receivedPlace->tags,
        'insert_time' => (int)$receivedPlace->insert_time,
    ];

}
