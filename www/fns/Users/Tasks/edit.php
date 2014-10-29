<?php

namespace Users\Tasks;

function edit ($mysqli, $user, $task, $text, $deadline_time,
    $tags, $tag_names, $top_priority, $updateApiKey = null) {

    $id = $task->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tasks/edit.php";
    \Tasks\edit($mysqli, $id, $text, $deadline_time,
        $tags, $tag_names, $top_priority, $updateApiKey);

    if ($task->num_tags) {
        include_once "$fnsDir/TaskTags/deleteOnTask.php";
        \TaskTags\deleteOnTask($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/TaskTags/add.php";
        \TaskTags\add($mysqli, $task->id_users, $id, $tag_names,
            $text, $deadline_time, $tags, $top_priority);
    }

    include_once __DIR__.'/Deadlines/invalidateIfNeeded.php';
    Deadlines\invalidateIfNeeded($mysqli, $user, $task->deadline_time);
    Deadlines\invalidateIfNeeded($mysqli, $user, $deadline_time);

}
