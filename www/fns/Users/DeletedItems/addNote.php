<?php

namespace Users\DeletedItems;

function addNote ($mysqli, $note) {
    include_once __DIR__.'/add.php';
    add($mysqli, $note->id_users, 'note', [
        'id' => $note->id,
        'text' => $note->text,
        'title' => $note->title,
        'tags' => $note->tags,
        'encrypt' => $note->encrypt,
        'insert_api_key_id' => $note->insert_api_key_id,
        'insert_time' => $note->insert_time,
        'update_api_key_id' => $note->update_api_key_id,
        'update_time' => $note->update_time,
        'revision' => $note->revision,
    ]);
}
