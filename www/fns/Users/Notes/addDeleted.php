<?php

namespace Users\Notes;

function addDeleted ($mysqli, $id_users, $object) {

    $id = $object->id;
    $text = $object->text;
    $tags = $object->tags;
    $encrypt = $object->encrypt;

    include_once __DIR__.'/../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../../Notes/addDeleted.php';
    \Notes\addDeleted($mysqli, $id, $id_users, $text, $tags, $encrypt,
        $object->insert_time, $object->update_time);

    include_once __DIR__.'/../../NoteTags/add.php';
    \NoteTags\add($mysqli, $id_users, $id, $tag_names, $text, $encrypt);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
