<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once '../../fns/Notes/indexOnUser.php';
$notes = Notes\indexOnUser($mysqli, $user->id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($note) {
        return [
            'id' => (int)$note->id_notes,
            'text' => $note->text,
            'tags' => $note->tags,
            'insert_time' => (int)$note->insert_time,
            'update_time' => (int)$note->update_time,
        ];
    }, $notes)
);
