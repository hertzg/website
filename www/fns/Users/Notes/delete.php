<?php

namespace Users\Notes;

function delete ($mysqli, $note) {

    $id = $note->id_notes;

    include_once __DIR__.'/../../Notes/delete.php';
    \Notes\delete($mysqli, $id);

    include_once __DIR__.'/../../NoteTags/deleteOnNote.php';
    \NoteTags\deleteOnNote($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $note->id_users, -1);

}
