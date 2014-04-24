<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once 'fns/require_bookmark.php';
list($id, $bookmark) = require_bookmark($mysqli, $id_users);

header('Content-Type: application/json');
echo json_encode([
    'id' => $id,
    'url' => $bookmark->url,
    'title' => $bookmark->title,
    'tags' => $bookmark->tags,
    'insert_time' => $bookmark->insert_time,
    'update_time' => $bookmark->update_time,
]);
