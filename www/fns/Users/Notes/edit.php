<?php

namespace Users\Notes;

function edit ($mysqli, $id_users, $id, $text, $tags, $tag_names, $encrypt) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Notes/edit.php";
    \Notes\edit($mysqli, $id_users, $id, $text, $tags, $tag_names, $encrypt);

    include_once "$fnsDir/NoteTags/deleteOnNote.php";
    \NoteTags\deleteOnNote($mysqli, $id);

    if ($tag_names) {
        include_once "$fnsDir/NoteTags/add.php";
        \NoteTags\add($mysqli, $id_users, $id, $tag_names, $text, $encrypt);
    }

}
