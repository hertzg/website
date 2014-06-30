<?php

function request_task_params (&$errors) {

    include_once __DIR__.'/../../fns/Tasks/request.php';
    list($text, $top_priority) = Tasks\request();

    if ($text === '') $errors[] = 'Enter text.';

    include_once __DIR__.'/../../fns/request_tags.php';
    request_tags($tags, $tag_names, $errors);

    $deadline_time = null;

    return [$text, $deadline_time, $tags, $tag_names, $top_priority];

}
