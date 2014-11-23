<?php

namespace Users\Notes;

function edit ($mysqli, $note, $text, $tags,
    $tag_names, $encrypt, $updateApiKey = null) {

    $id = $note->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Notes/edit.php";
    \Notes\edit($mysqli, $id, $text,
        $tags, $tag_names, $encrypt, $updateApiKey);

    if ($note->num_tags) {
        include_once "$fnsDir/NoteTags/deleteOnNote.php";
        \NoteTags\deleteOnNote($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/NoteTags/add.php";
        \NoteTags\add($mysqli, $note->id_users,
            $id, $tag_names, $text, $tags, $encrypt);
    }

}
