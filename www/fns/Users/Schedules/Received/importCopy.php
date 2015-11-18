<?php

namespace Users\Schedules\Received;

function importCopy ($mysqli, $user, $receivedSchedule, $insertApiKey = null) {

    $tags = $receivedSchedule->tags;

    include_once __DIR__.'/../../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../add.php';
    return \Users\Schedules\add($mysqli, $user, $receivedSchedule->text,
        $receivedSchedule->interval, $receivedSchedule->offset,
        $tags, $tag_names, $insertApiKey);

}
