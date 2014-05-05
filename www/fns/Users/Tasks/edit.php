<?php

namespace Users\Tasks;

function edit ($mysqli, $id_users, $id,
    $text, $tags, $tag_names, $top_priority) {

    include_once __DIR__.'/../../Tasks/edit.php';
    \Tasks\edit($mysqli, $id_users, $id, $text, $tags, $top_priority);

    include_once __DIR__.'/../../TaskTags/deleteOnTask.php';
    \TaskTags\deleteOnTask($mysqli, $id);

    include_once __DIR__.'/../../TaskTags/add.php';
    \TaskTags\add($mysqli, $id_users, $id, $tag_names,
        $text, $top_priority, $tags, $top_priority);

}
