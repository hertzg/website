<?php

function request_task_params () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Tasks/request.php";
    list($text, $top_priority) = Tasks\request();

    include_once "$fnsDir/request_strings.php";
    list($deadline_time) = request_strings('deadline_time');

    if ($deadline_time === '') {
        $deadline_time = null;
    } else {
        include_once "$fnsDir/time_today.php";
        $deadline_time = time_today($deadline_time);
        $deadline_time = max($deadline_time, time_today());
    }

    if ($text === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_TEXT');
    }

    include_once __DIR__.'/../../fns/request_tags.php';
    list($tags, $tag_names) = request_tags();

    return [$text, $deadline_time, $tags, $tag_names, $top_priority];

}
