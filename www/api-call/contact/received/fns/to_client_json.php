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
        'phone1_label' => $receivedContact->phone1_label,
        'phone2' => $receivedContact->phone2,
        'phone2_label' => $receivedContact->phone2_label,
        'birthday_time' => (int)$receivedContact->birthday_time,
        'username' => $receivedContact->username,
        'timezone' => $receivedContact->timezone,
        'tags' => $receivedContact->tags,
        'notes' => $receivedContact->notes,
        'favorite' => (bool)$receivedContact->favorite,
        'insert_time' => (int)$receivedContact->insert_time,
    ];
}
