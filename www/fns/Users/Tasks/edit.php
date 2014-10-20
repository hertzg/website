<?php

namespace Users\Tasks;

function edit ($mysqli, $task, $text,
    $deadline_time, $tags, $tag_names, $top_priority) {

    $id = $task->id_tasks;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tasks/edit.php";
    \Tasks\edit($mysqli, $id, $text, $deadline_time,
        $tags, $tag_names, $top_priority);

    if ($task->num_tags) {
        include_once "$fnsDir/TaskTags/deleteOnTask.php";
        \TaskTags\deleteOnTask($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/TaskTags/add.php";
        \TaskTags\add($mysqli, $task->id_users, $id, $tag_names,
            $text, $deadline_time, $tags, $top_priority);
    }

}
