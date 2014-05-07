<?php

namespace Users\Notes;

function delete ($mysqli, $id, $id_users) {

    include_once __DIR__.'/../../Notes/delete.php';
    \Notes\delete($mysqli, $id);

    include_once __DIR__.'/../../NoteTags/deleteOnNote.php';
    \NoteTags\deleteOnNote($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

}
