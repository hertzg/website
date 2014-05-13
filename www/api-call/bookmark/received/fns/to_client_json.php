<?php

function to_client_json ($receivedBookmark) {
    return [
        'id' => (int)$receivedBookmark->id,
        'sender_username' => $receivedBookmark->sender_username,
        'url' => $receivedBookmark->url,
        'title' => $receivedBookmark->title,
        'tags' => $receivedBookmark->tags,
        'insert_time' => (int)$receivedBookmark->insert_time,
    ];
}
