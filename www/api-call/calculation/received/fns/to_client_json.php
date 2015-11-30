<?php

function to_client_json ($receivedCalculation) {

    $sender_username = $receivedCalculation->sender_username;
    $sender_address = $receivedCalculation->sender_address;
    if ($sender_address !== null) $sender_username .= "@$sender_address";

    return [
        'id' => (int)$receivedCalculation->id,
        'sender_username' => $sender_username,
        'url' => $receivedCalculation->url,
        'title' => $receivedCalculation->title,
        'tags' => $receivedCalculation->tags,
        'insert_time' => (int)$receivedCalculation->insert_time,
    ];

}
