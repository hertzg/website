<?php

namespace Users\Notes;

function add ($mysqli, $id_users, $text,
    $tags, $tag_names, $encrypt, $insertApiKey = null) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Notes/add.php";
    $id = \Notes\add($mysqli, $id_users, $text,
        $tags, $tag_names, $encrypt, $insertApiKey);

    if ($tag_names) {
        include_once "$fnsDir/NoteTags/add.php";
        \NoteTags\add($mysqli, $id_users, $id,
            $tag_names, $text, $tags, $encrypt);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
