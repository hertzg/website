<?php

namespace Users\Tasks;

function edit ($mysqli, $id_users, $id,
    $text, $tags, $tag_names, $top_priority) {

    $deadline_time = null;

    include_once __DIR__.'/../../Tasks/edit.php';
    \Tasks\edit($mysqli, $id_users, $id, $text,
        $deadline_time, $tags, $top_priority);

    include_once __DIR__.'/../../TaskTags/deleteOnTask.php';
    \TaskTags\deleteOnTask($mysqli, $id);

    include_once __DIR__.'/../../TaskTags/add.php';
    \TaskTags\add($mysqli, $id_users, $id, $tag_names,
        $text, $tags, $top_priority);

}
