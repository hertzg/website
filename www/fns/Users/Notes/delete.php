<?php

namespace Users\Notes;

function delete ($mysqli, $note) {

    $id = $note->id_notes;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Notes/delete.php";
    \Notes\delete($mysqli, $id);

    include_once "$fnsDir/NoteTags/deleteOnNote.php";
    \NoteTags\deleteOnNote($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $note->id_users, -1);

    include_once "$fnsDir/DeletedItems/Notes/add.php";
    \DeletedItems\Notes\add($mysqli, $note);

}
