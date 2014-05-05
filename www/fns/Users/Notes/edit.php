<?php

namespace Users\Notes;

function edit ($mysqli, $id_users, $id, $text, $tags, $tag_names) {

    include_once __DIR__.'/../../Notes/edit.php';
    \Notes\edit($mysqli, $id_users, $id, $text, $tags);

    include_once __DIR__.'/../../NoteTags/deleteOnNote.php';
    \NoteTags\deleteOnNote($mysqli, $id);

    include_once __DIR__.'/../../NoteTags/add.php';
    \NoteTags\add($mysqli, $id_users, $id, $tag_names, $text);

}
