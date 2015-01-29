<?php

namespace Users\DeletedItems;

function addReceivedContact ($mysqli, $receivedContact, $apiKey = null) {
    include_once __DIR__.'/add.php';
    add($mysqli, $receivedContact->receiver_id_users, 'receivedContact', [
        'id' => $receivedContact->id,
        'full_name' => $receivedContact->full_name,
        'alias' => $receivedContact->alias,
        'address' => $receivedContact->address,
        'email' => $receivedContact->email,
        'phone1' => $receivedContact->phone1,
        'phone2' => $receivedContact->phone2,
        'birthday_time' => $receivedContact->birthday_time,
        'username' => $receivedContact->username,
        'timezone' => $receivedContact->timezone,
        'tags' => $receivedContact->tags,
        'notes' => $receivedContact->notes,
        'favorite' => $receivedContact->favorite,
        'insert_time' => $receivedContact->insert_time,
        'sender_id_users' => $receivedContact->sender_id_users,
        'sender_username' => $receivedContact->sender_username,
        'archived' => $receivedContact->archived,
        'photo_id' => $receivedContact->photo_id,
    ], $apiKey);
}
