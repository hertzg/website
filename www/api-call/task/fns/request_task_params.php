<?php

function request_task_params () {

    include_once __DIR__.'/../../../fns/Tasks/requestText.php';
    $text = Tasks\requestText();

    if ($text === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_TEXT');
    }

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($top_priority) = request_strings('top_priority');
    $top_priority = (bool)$top_priority;

    include_once __DIR__.'/../../fns/request_tags.php';
    list($tags, $tag_names) = request_tags();

    return [$text, $tags, $tag_names, $top_priority];

}
