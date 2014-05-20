<?php

namespace Users\Tasks\Received;

function import ($mysqli, $receivedTask) {

    $tags = $receivedTask->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    $id = \Users\Tasks\add($mysqli, $receivedTask->receiver_id_users,
        $receivedTask->text, $receivedTask->top_priority, $tags, $tag_names);

    include_once __DIR__.'/delete.php';
    delete($mysqli, $receivedTask);

    return $id;

}
