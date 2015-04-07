<?php

namespace Tasks;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_text.php";
    $text = request_text('text');

    include_once "$fnsDir/request_strings.php";
    list($deadline_time, $tags, $top_priority) = request_strings(
        'deadline_time', 'tags', 'top_priority');

    include_once "$fnsDir/str_collapse_spaces.php";
    $tags = str_collapse_spaces($tags);

    if ($deadline_time === '') $deadline_time = null;
    $top_priority = (bool)$top_priority;

    return [$text, $deadline_time, $tags, $top_priority];

}
