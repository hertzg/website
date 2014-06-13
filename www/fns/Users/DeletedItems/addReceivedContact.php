<?php

namespace Users\DeletedItems;

function addReceivedContact ($mysqli, $receivedContact) {
    $id_users = $receivedContact->receiver_id_users;
    include_once __DIR__.'/../../DeletedItems/add.php';
    \DeletedItems\add($mysqli, $id_users, 'receivedContact', [
        'id' => $receivedContact->id,
        'full_name' => $receivedContact->full_name,
        'alias' => $receivedContact->alias,
        'address' => $receivedContact->address,
        'email' => $receivedContact->email,
        'phone1' => $receivedContact->phone1,
        'phone2' => $receivedContact->phone2,
        'birthday_time' => $receivedContact->birthday_time,
        'username' => $receivedContact->username,
        'tags' => $receivedContact->tags,
        'favorite' => $receivedContact->favorite,
        'insert_time' => $receivedContact->insert_time,
        'sender_id_users' => $receivedContact->sender_id_users,
        'sender_username' => $receivedContact->sender_username,
        'archived' => $receivedContact->archived,
    ]);
}
