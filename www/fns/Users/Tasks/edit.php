<?php

namespace Users\Tasks;

function edit ($mysqli, $id_users, $id, $text,
    $deadline_time, $tags, $tag_names, $top_priority) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tasks/edit.php";
    \Tasks\edit($mysqli, $id_users, $id, $text,
        $deadline_time, $tags, $tag_names, $top_priority);

    include_once "$fnsDir/TaskTags/deleteOnTask.php";
    \TaskTags\deleteOnTask($mysqli, $id);

    include_once "$fnsDir/TaskTags/add.php";
    \TaskTags\add($mysqli, $id_users, $id, $tag_names,
        $text, $deadline_time, $tags, $top_priority);

}
