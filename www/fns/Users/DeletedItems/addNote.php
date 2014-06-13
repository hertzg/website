<?php

namespace Users\DeletedItems;

function addNote ($mysqli, $note) {
    include_once __DIR__.'/../../DeletedItems/add.php';
    \DeletedItems\add($mysqli, $note->id_users, 'note', [
        'id' => $note->id_notes,
        'text' => $note->text,
        'tags' => $note->tags,
        'encrypt' => $note->encrypt,
        'insert_time' => $note->insert_time,
        'update_time' => $note->update_time,
    ]);
}
