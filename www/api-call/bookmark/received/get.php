<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_received_bookmark.php';
$receivedBookmark = require_received_bookmark($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode([
    'id' => (int)$receivedBookmark->id,
    'sender_username' => $receivedBookmark->sender_username,
    'url' => $receivedBookmark->url,
    'title' => $receivedBookmark->title,
    'tags' => $receivedBookmark->tags,
    'insert_time' => (int)$receivedBookmark->insert_time,
]);
