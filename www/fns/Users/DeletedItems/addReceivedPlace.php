<?php

namespace Users\DeletedItems;

function addReceivedPlace ($mysqli, $receivedPlace, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $receivedPlace->receiver_id_users, 'receivedPlace', [
        'id' => $receivedPlace->id,
        'latitude' => $receivedPlace->latitude,
        'longitude' => $receivedPlace->longitude,
        'altitude' => $receivedPlace->altitude,
        'name' => $receivedPlace->name,
        'description' => $receivedPlace->description,
        'tags' => $receivedPlace->tags,
        'insert_time' => $receivedPlace->insert_time,
        'sender_address' => $receivedPlace->sender_address,
        'sender_id_users' => $receivedPlace->sender_id_users,
        'sender_username' => $receivedPlace->sender_username,
        'archived' => $receivedPlace->archived,
    ], $apiKey);
}
