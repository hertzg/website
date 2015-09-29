<?php

function request_task_params ($user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Tasks/request.php";
    list($text, $deadline_time, $tags, $top_priority) = Tasks\request();

    if ($deadline_time !== null) {

        include_once "$fnsDir/daytime.php";
        $deadline_time = daytime($deadline_time);

        include_once "$fnsDir/user_time_today.php";
        $deadline_time = max($deadline_time, user_time_today($user));

    }

    if ($text === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_TEXT"');
    }

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$text, $deadline_time, $tags, $tag_names, $top_priority];

}
