<?php

function to_client_json ($receivedContact) {
    $timezone = $receivedContact->timezone;
    return [
        'id' => (int)$receivedContact->id,
        'sender_username' => $receivedContact->sender_username,
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
        'birthday_time' => (int)$receivedContact->birthday_time,
        'username' => $receivedContact->username,
        'timezone' => $timezone === null ? null : (int)$timezone,
        'tags' => $receivedContact->tags,
        'notes' => $receivedContact->notes,
        'favorite' => (bool)$receivedContact->favorite,
        'insert_time' => (int)$receivedContact->insert_time,
    ];
}
