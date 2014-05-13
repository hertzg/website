<?php

include_once '../../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_received_note.php';
$receivedNote = require_received_note($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode([
    'id' => (int)$receivedNote->id,
    'sender_username' => $receivedNote->sender_username,
    'text' => $receivedNote->text,
    'tags' => $receivedNote->tags,
    'insert_time' => (int)$receivedNote->insert_time,
]);
