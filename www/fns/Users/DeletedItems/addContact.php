<?php

namespace Users\DeletedItems;

function addContact ($mysqli, $contact) {
    include_once __DIR__.'/add.php';
    add($mysqli, $contact->id_users, 'contact', [
        'id' => $contact->id_contacts,
        'full_name' => $contact->full_name,
        'alias' => $contact->alias,
        'address' => $contact->address,
        'email' => $contact->email,
        'phone1' => $contact->phone1,
        'phone2' => $contact->phone2,
        'birthday_time' => $contact->birthday_time,
        'username' => $contact->username,
        'timezone' => $contact->timezone,
        'tags' => $contact->tags,
        'favorite' => $contact->favorite,
        'insert_time' => $contact->insert_time,
        'update_time' => $contact->update_time,
    ]);
}
