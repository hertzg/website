<?php

namespace Users\DeletedItems;

function addReceivedSchedule ($mysqli, $receivedSchedule, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $receivedSchedule->receiver_id_users, 'receivedSchedule', [
        'id' => $receivedSchedule->id,
        'text' => $receivedSchedule->text,
        'interval' => $receivedSchedule->interval,
        'offset' => $receivedSchedule->offset,
        'tags' => $receivedSchedule->tags,
        'insert_time' => $receivedSchedule->insert_time,
        'sender_address' => $receivedSchedule->sender_address,
        'sender_id_users' => $receivedSchedule->sender_id_users,
        'sender_username' => $receivedSchedule->sender_username,
        'archived' => $receivedSchedule->archived,
    ], $apiKey);
}
