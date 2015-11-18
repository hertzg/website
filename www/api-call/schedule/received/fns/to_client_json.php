<?php

function to_client_json ($receivedSchedule) {

    $sender_username = $receivedSchedule->sender_username;
    $sender_address = $receivedSchedule->sender_address;
    if ($sender_address !== null) $sender_username .= "@$sender_address";

    return [
        'id' => (int)$receivedSchedule->id,
        'sender_username' => $sender_username,
        'text' => $receivedSchedule->text,
        'interval' => (int)$receivedSchedule->interval,
        'offset' => (int)$receivedSchedule->offset,
        'tags' => $receivedSchedule->tags,
        'insert_time' => (int)$receivedSchedule->insert_time,
    ];

}
