<?php

function to_client_json ($receivedNote) {

    $sender_username = $receivedNote->sender_username;
    $sender_address = $receivedNote->sender_address;
    if ($sender_address !== null) $sender_username .= "@$sender_address";

    return [
        'id' => (int)$receivedNote->id,
        'sender_username' => $sender_username,
        'text' => $receivedNote->text,
        'tags' => $receivedNote->tags,
        'encrypt_in_listings' => (bool)$receivedNote->encrypt_in_listings,
        'insert_time' => (int)$receivedNote->insert_time,
    ];

}
