<?php

function request_task_params (&$errors) {

    include_once __DIR__.'/../../fns/Tasks/requestText.php';
    $text = Tasks\requestText();

    include_once __DIR__.'/../../fns/request_strings.php';
    list($top_priority) = request_strings('top_priority');

    $top_priority = (bool)$top_priority;

    if ($text === '') $errors[] = 'Enter text.';

    include_once __DIR__.'/../../fns/request_tags.php';
    request_tags($tags, $tag_names, $errors);

    return [$text, $tags, $tag_names, $top_priority];

}
