<?php

namespace Users\Tasks;

function edit ($mysqli, $user, $task, $text, $deadline_time,
    $tags, $tag_names, $top_priority, &$changed, $updateApiKey = null) {

    $deadline_time_null = $task->deadline_time === null &&
        $deadline_time === null;
    $deadline_time_same = $deadline_time_null ||
        (int)$task->deadline_time === $deadline_time;

    if ($task->text === $text &&
        $deadline_time_same && $task->tags === $tags &&
        (bool)$task->top_priority === $top_priority) return;

    $changed = true;
    $id = $task->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tasks/maxLengths.php";
    include_once "$fnsDir/text_title.php";
    $title = text_title($text, \Tasks\maxLengths()['title']);

    $update_time = time();

    include_once "$fnsDir/Tasks/edit.php";
    \Tasks\edit($mysqli, $id, $text, $title, $deadline_time,
        $tags, $tag_names, $top_priority, $update_time, $updateApiKey);

    if ($task->num_tags) {
        include_once "$fnsDir/TaskTags/deleteOnTask.php";
        \TaskTags\deleteOnTask($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/TaskTags/add.php";
        \TaskTags\add($mysqli, $task->id_users, $id,
            $tag_names, $text, $title, $deadline_time,
            $tags, $top_priority, $task->insert_time, $update_time);
    }

    if ($task->deadline_time) {
        include_once __DIR__.'/Deadlines/invalidateIfNeeded.php';
        Deadlines\invalidateIfNeeded($mysqli, $user, $task->deadline_time);
    }
    if ($deadline_time !== null) {
        include_once __DIR__.'/Deadlines/invalidateIfNeeded.php';
        Deadlines\invalidateIfNeeded($mysqli, $user, $deadline_time);
    }

}
