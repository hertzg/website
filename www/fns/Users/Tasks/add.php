<?php

namespace Users\Tasks;

function add ($mysqli, $id_users, $text, $tags, $tag_names, $top_priority) {

    include_once __DIR__.'/../../Tasks/add.php';
    $id = \Tasks\add($mysqli, $id_users, $text, $tags, $top_priority);

    include_once __DIR__.'/../../TaskTags/add.php';
    \TaskTags\add($mysqli, $id_users, $id,
        $tag_names, $text, $top_priority, $tags);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
