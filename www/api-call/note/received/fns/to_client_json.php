<?php

function to_client_json ($receivedNote) {
    return [
        'id' => (int)$receivedNote->id,
        'sender_username' => $receivedNote->sender_username,
        'text' => $receivedNote->text,
        'tags' => $receivedNote->tags,
        'encrypt' => (bool)$receivedNote->encrypt,
        'insert_time' => (int)$receivedNote->insert_time,
    ];
}
