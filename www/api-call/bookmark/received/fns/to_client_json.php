<?php

function to_client_json ($receivedBookmark) {

    $sender_username = $receivedBookmark->sender_username;
    $sender_address = $receivedBookmark->sender_address;
    if ($sender_address !== null) $sender_username .= "@$sender_address";

    return [
        'id' => (int)$receivedBookmark->id,
        'sender_username' => $sender_username,
        'url' => $receivedBookmark->url,
        'title' => $receivedBookmark->title,
        'tags' => $receivedBookmark->tags,
        'insert_time' => (int)$receivedBookmark->insert_time,
    ];

}
