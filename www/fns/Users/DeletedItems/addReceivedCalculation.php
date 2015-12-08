<?php

namespace Users\DeletedItems;

function addReceivedCalculation ($mysqli, $receivedCalculation, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $receivedCalculation->receiver_id_users, 'receivedCalculation', [
        'id' => $receivedCalculation->id,
        'expression' => $receivedCalculation->expression,
        'title' => $receivedCalculation->title,
        'tags' => $receivedCalculation->tags,
        'value' => $receivedCalculation->value,
        'error' => $receivedCalculation->error,
        'error_char' => $receivedCalculation->error_char,
        'insert_time' => $receivedCalculation->insert_time,
        'sender_address' => $receivedCalculation->sender_address,
        'sender_id_users' => $receivedCalculation->sender_id_users,
        'sender_username' => $receivedCalculation->sender_username,
        'archived' => $receivedCalculation->archived,
    ], $apiKey);
}
