<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once '../../fns/Bookmarks/indexOnUser.php';
$bookmarks = Bookmarks\indexOnUser($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($bookmark) {
        return [
            'id' => (int)$bookmark->id_bookmarks,
            'url' => $bookmark->url,
            'title' => $bookmark->title,
            'tags' => $bookmark->tags,
            'insert_time' => (int)$bookmark->insert_time,
            'update_time' => (int)$bookmark->update_time,
        ];
    }, $bookmarks)
);
