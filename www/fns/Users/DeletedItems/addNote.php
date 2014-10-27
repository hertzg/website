<?php

namespace Users\DeletedItems;

function addNote ($mysqli, $note) {
    include_once __DIR__.'/add.php';
    add($mysqli, $note->id_users, 'note', [
        'id' => $note->id,
        'text' => $note->text,
        'tags' => $note->tags,
        'encrypt' => $note->encrypt,
        'insert_time' => $note->insert_time,
        'update_time' => $note->update_time,
    ]);
}
