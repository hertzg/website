<?php

namespace Users\Tasks;

function addDeleted ($mysqli, $id_users, $object) {

    $id = $object->id;
    $text = $object->text;
    $tags = $object->tags;
    $top_priority = $object->top_priority;

    include_once __DIR__.'/../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../../Tasks/addDeleted.php';
    \Tasks\addDeleted($mysqli, $id, $id_users, $text, $top_priority, $tags,
        $object->insert_time, $object->update_time);

    include_once __DIR__.'/../../TaskTags/add.php';
    \TaskTags\add($mysqli, $id_users, $id,
        $tag_names, $text, $top_priority, $tags);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
