<?php

namespace Users\DeletedItems;

function addReceivedNote ($mysqli, $receivedNote) {
    include_once __DIR__.'/add.php';
    add($mysqli, $receivedNote->receiver_id_users, 'receivedNote', [
        'id' => $receivedNote->id,
        'text' => $receivedNote->text,
        'title' => $receivedNote->title,
        'tags' => $receivedNote->tags,
        'encrypt' => $receivedNote->encrypt,
        'insert_time' => $receivedNote->insert_time,
        'sender_id_users' => $receivedNote->sender_id_users,
        'sender_username' => $receivedNote->sender_username,
        'archived' => $receivedNote->archived,
    ]);
}
