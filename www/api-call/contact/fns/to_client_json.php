<?php

function to_client_json ($contact) {
    return [
        'id' => (int)$contact->id_contacts,
        'full_name' => $contact->full_name,
        'alias' => $contact->alias,
        'address' => $contact->address,
        'email' => $contact->email,
        'phone1' => $contact->phone1,
        'phone2' => $contact->phone2,
        'birthday_time' => (int)$contact->birthday_time,
        'username' => $contact->username,
        'tags' => $contact->tags,
        'favorite' => (bool)$contact->favorite,
        'insert_time' => (int)$contact->insert_time,
        'update_time' => (int)$contact->update_time,
    ];
}
