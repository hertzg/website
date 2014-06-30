<?php

function request_task_params (&$errors) {

    include_once __DIR__.'/../../fns/Tasks/request.php';
    list($text, $top_priority) = Tasks\request();

    include_once __DIR__.'/../../fns/request_strings.php';
    list($deadline_day, $deadline_month, $deadline_year) = request_strings(
        'deadline_day', 'deadline_month', 'deadline_year');

    $deadline_day = abs((int)$deadline_day);
    $deadline_month = abs((int)$deadline_month);
    $deadline_year = abs((int)$deadline_year);

    if ($text === '') $errors[] = 'Enter text.';

    include_once __DIR__.'/../fns/parse_deadline.php';
    parse_deadline($deadline_day, $deadline_month,
        $deadline_year, $errors, $deadline_time);

    include_once __DIR__.'/../../fns/request_tags.php';
    request_tags($tags, $tag_names, $errors);

    $deadline_time = null;

    return [$text, $deadline_day, $deadline_month, $deadline_year,
        $deadline_time, $tags, $tag_names, $top_priority];

}
