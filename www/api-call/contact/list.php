<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once '../../fns/Contacts/indexOnUser.php';
$contacts = Contacts\indexOnUser($mysqli, $id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($contact) {
        return [
            'id' => (int)$contact->id_contacts,
            'text' => $contact->text,
            'tags' => $contact->tags,
            'insert_time' => (int)$contact->insert_time,
            'update_time' => (int)$contact->update_time,
        ];
    }, $contacts)
);
