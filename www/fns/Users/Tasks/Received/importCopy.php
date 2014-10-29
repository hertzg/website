<?php

namespace Users\Tasks\Received;

function importCopy ($mysqli, $user, $receivedTask, $insertApiKey = null) {

    $tags = $receivedTask->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    return \Users\Tasks\add($mysqli, $user, $receivedTask->text,
        $receivedTask->deadline_time, $tags, $tag_names,
        $receivedTask->top_priority, $insertApiKey);

}
