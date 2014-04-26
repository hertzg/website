<?php

function request_task_params () {

    include_once __DIR__.'/../../../fns/Tasks/request.php';
    list($text, $top_priority) = Tasks\request();

    if ($text === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_TEXT');
    }

    include_once __DIR__.'/../../fns/request_tags.php';
    list($tags, $tag_names) = request_tags();

    return [$text, $tags, $tag_names, $top_priority];

}
