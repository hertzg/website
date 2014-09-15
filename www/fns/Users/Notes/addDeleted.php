<?php

namespace Users\Notes;

function addDeleted ($mysqli, $id_users, $data) {

    $id = $data->id;
    $text = $data->text;
    $tags = $data->tags;
    $encrypt = $data->encrypt;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Notes/addDeleted.php";
    \Notes\addDeleted($mysqli, $id, $id_users, $text, $tags, $encrypt,
        $data->insert_time, $data->update_time);

    include_once "$fnsDir/NoteTags/add.php";
    \NoteTags\add($mysqli, $id_users, $id, $tag_names, $text, $encrypt);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
