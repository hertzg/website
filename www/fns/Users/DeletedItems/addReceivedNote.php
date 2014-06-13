<?php

namespace Users\DeletedItems;

function addReceivedNote ($mysqli, $receivedNote) {
    $id_users = $receivedNote->receiver_id_users;
    include_once __DIR__.'/../../DeletedItems/add.php';
    \DeletedItems\add($mysqli, $id_users, 'receivedNote', [
        'id' => $receivedNote->id,
        'text' => $receivedNote->text,
        'tags' => $receivedNote->tags,
        'encrypt' => $receivedNote->encrypt,
        'insert_time' => $receivedNote->insert_time,
        'sender_id_users' => $receivedNote->sender_id_users,
        'sender_username' => $receivedNote->sender_username,
        'archived' => $receivedNote->archived,
    ]);
}
