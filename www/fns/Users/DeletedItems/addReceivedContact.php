<?php

namespace Users\DeletedItems;

function addReceivedContact ($mysqli, $receivedContact, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $receivedContact->receiver_id_users, 'receivedContact', [
        'id' => $receivedContact->id,
        'full_name' => $receivedContact->full_name,
        'alias' => $receivedContact->alias,
        'address' => $receivedContact->address,
        'email1' => $receivedContact->email1,
        'email1_label' => $receivedContact->email1_label,
        'email2' => $receivedContact->email2,
        'email2_label' => $receivedContact->email2_label,
        'phone1' => $receivedContact->phone1,
        'phone1_label' => $receivedContact->phone1_label,
        'phone2' => $receivedContact->phone2,
        'phone2_label' => $receivedContact->phone2_label,
        'birthday_time' => $receivedContact->birthday_time,
        'username' => $receivedContact->username,
        'timezone' => $receivedContact->timezone,
        'tags' => $receivedContact->tags,
        'notes' => $receivedContact->notes,
        'favorite' => $receivedContact->favorite,
        'insert_time' => $receivedContact->insert_time,
        'sender_address' => $receivedContact->sender_address,
        'sender_id_users' => $receivedContact->sender_id_users,
        'sender_username' => $receivedContact->sender_username,
        'archived' => $receivedContact->archived,
        'photo_id' => $receivedContact->photo_id,
    ], $apiKey);
}
