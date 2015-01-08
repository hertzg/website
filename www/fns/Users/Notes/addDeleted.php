<?php

namespace Users\Notes;

function addDeleted ($mysqli, $id_users, $data) {

    $id = $data->id;
    $text = $data->text;
    $tags = $data->tags;
    $encrypt = $data->encrypt;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Notes/maxLengths.php";
    include_once "$fnsDir/text_title.php";
    $title = text_title($text, \Notes\maxLengths()['title']);

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Notes/addDeleted.php";
    \Notes\addDeleted($mysqli, $id, $id_users, $text, $title, $tags,
        $tag_names, $encrypt, $data->insert_time, $data->update_time);

    if ($tag_names) {
        include_once "$fnsDir/NoteTags/add.php";
        \NoteTags\add($mysqli, $id_users, $id,
            $tag_names, $text, $title, $tags, $encrypt);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
