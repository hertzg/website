<?php

function to_client_json ($receivedContact) {
    return [
        'id' => (int)$receivedContact->id,
        'sender_username' => $receivedContact->sender_username,
        'full_name' => $receivedContact->full_name,
        'alias' => $receivedContact->alias,
        'address' => $receivedContact->address,
        'email' => $receivedContact->email,
        'phone1' => $receivedContact->phone1,
        'phone2' => $receivedContact->phone2,
        'birthday_time' => (int)$receivedContact->birthday_time,
        'username' => $receivedContact->username,
        'tags' => $receivedContact->tags,
        'favorite' => (bool)$receivedContact->favorite,
        'insert_time' => (int)$receivedContact->insert_time,
    ];
}
