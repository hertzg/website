<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once '../../../fns/ReceivedBookmarks/indexOnReceiver.php';
$receivedBookmarks = ReceivedBookmarks\indexOnReceiver($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($receivedBookmarks) {
        return [
            'id' => (int)$receivedBookmarks->id,
            'sender_username' => $receivedBookmarks->sender_username,
            'url' => $receivedBookmarks->url,
            'title' => $receivedBookmarks->title,
            'tags' => $receivedBookmarks->tags,
            'insert_time' => (int)$receivedBookmarks->insert_time,
        ];
    }, $receivedBookmarks)
);
