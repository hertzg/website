<?php

function to_client_json ($note) {
    return [
        'id' => (int)$note->id_notes,
        'text' => $note->text,
        'tags' => $note->tags,
        'insert_time' => (int)$note->insert_time,
        'update_time' => (int)$note->update_time,
    ];
}
