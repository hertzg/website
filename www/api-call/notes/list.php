<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once '../../fns/Notes/indexOnUser.php';
$notes = Notes\indexOnUser($mysqli, $id_users);

header('Content-Type: application/json');
echo json_encode(
    array_map(function ($note) {
        return [
            'id' => $note->id_notes,
            'text' => $note->text,
            'tags' => $note->tags,
            'insert_time' => $note->insert_time,
            'update_time' => $note->update_time,
        ];
    }, $notes)
);
