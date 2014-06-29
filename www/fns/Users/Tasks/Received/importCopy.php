<?php

namespace Users\Tasks\Received;

function importCopy ($mysqli, $receivedTask) {

    $tags = $receivedTask->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    return \Users\Tasks\add($mysqli, $receivedTask->receiver_id_users,
        $receivedTask->text, $tags, $tag_names, $receivedTask->top_priority);

}
