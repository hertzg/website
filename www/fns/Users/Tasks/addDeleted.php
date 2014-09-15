<?php

namespace Users\Tasks;

function addDeleted ($mysqli, $id_users, $data) {

    $id = $data->id;
    $text = $data->text;
    $deadline_time = $data->deadline_time;
    $tags = $data->tags;
    $top_priority = $data->top_priority;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Tasks/addDeleted.php";
    \Tasks\addDeleted($mysqli, $id, $id_users, $text, $deadline_time,
        $tags, $top_priority, $data->insert_time, $data->update_time);

    include_once "$fnsDir/TaskTags/add.php";
    \TaskTags\add($mysqli, $id_users, $id, $tag_names,
        $text, $deadline_time, $tags, $top_priority);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
