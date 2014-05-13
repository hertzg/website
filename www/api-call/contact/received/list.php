<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once '../../../fns/ReceivedContacts/indexOnReceiver.php';
$receivedContacts = ReceivedContacts\indexOnReceiver($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($receivedContact) {
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
    }, $receivedContacts)
);
