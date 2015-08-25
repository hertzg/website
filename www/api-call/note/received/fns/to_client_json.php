<?php

function to_client_json ($receivedNote) {
    return [
        'id' => (int)$receivedNote->id,
        'sender_username' => $receivedNote->sender_username,
        'text' => $receivedNote->text,
        'tags' => $receivedNote->tags,
        'encrypt_in_listings' => (bool)$receivedNote->encrypt_in_listings,
        'insert_time' => (int)$receivedNote->insert_time,
    ];
}
