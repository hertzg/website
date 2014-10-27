<?php

function to_client_json ($note) {
    return [
        'id' => (int)$note->id,
        'text' => $note->text,
        'tags' => $note->tags,
        'encrypt' => (bool)$note->encrypt,
        'insert_time' => (int)$note->insert_time,
        'update_time' => (int)$note->update_time,
    ];
}
