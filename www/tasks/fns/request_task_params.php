<?php

function request_task_params ($user, &$errors, &$focus) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Tasks/request.php";
    list($text, $deadline_time, $tags, $top_priority) = Tasks\request();

    include_once "$fnsDir/request_strings.php";
    list($deadline_day, $deadline_month, $deadline_year) = request_strings(
        'deadline_day', 'deadline_month', 'deadline_year');

    $deadline_day = abs((int)$deadline_day);
    $deadline_month = abs((int)$deadline_month);
    $deadline_year = abs((int)$deadline_year);

    if ($text === '') {
        $errors[] = 'Enter text.';
        $focus = 'text';
    }

    include_once __DIR__.'/../fns/parse_deadline.php';
    parse_deadline($deadline_day, $deadline_month,
        $deadline_year, $user, $errors, $deadline_time);

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors, $focus);

    return [$text, $deadline_day, $deadline_month, $deadline_year,
        $deadline_time, $tags, $tag_names, $top_priority];

}
