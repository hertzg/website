<?php

namespace Users\Tasks;

function addDeleted ($mysqli, $user, $data) {

    $id_users = $user->id_users;
    $id = $data->id;
    $text = $data->text;
    $title = $data->title;
    $deadline_time = $data->deadline_time;
    $tags = $data->tags;
    $top_priority = $data->top_priority;
    $insert_time = $data->insert_time;
    $update_time = $data->update_time;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Tasks/addDeleted.php";
    \Tasks\addDeleted($mysqli, $id, $id_users, $text,
        $title, $deadline_time, $tags, $tag_names, $top_priority,
        $insert_time, $update_time, $data->revision);

    include_once "$fnsDir/TaskRevisions/setDeletedOnTask.php";
    \TaskRevisions\setDeletedOnTask($mysqli, $id, false);

    if ($tag_names) {
        include_once "$fnsDir/TaskTags/add.php";
        \TaskTags\add($mysqli, $id_users, $id,
            $tag_names, $text, $title, $deadline_time,
            $tags, $top_priority, $insert_time, $update_time);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    if ($deadline_time !== null) {
        include_once __DIR__.'/Deadlines/invalidateIfNeeded.php';
        Deadlines\invalidateIfNeeded($mysqli, $user, $deadline_time);
    }

}
