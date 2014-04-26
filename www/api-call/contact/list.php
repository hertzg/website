<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once '../../fns/Contacts/indexOnUser.php';
$contacts = Contacts\indexOnUser($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($contact) {
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
    }, $contacts)
);
