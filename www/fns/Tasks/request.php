<?php

namespace Tasks;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($deadline_time, $tags, $top_priority) = request_strings(
        'deadline_time', 'tags', 'top_priority');

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once "$fnsDir/request_text.php";
    $text = request_text('text');
    $text = mb_substr($text, 0, $maxLengths['text'], 'UTF-8');

    include_once "$fnsDir/str_collapse_spaces.php";
    $tags = str_collapse_spaces($tags);
    $tags = mb_substr($tags, 0, $maxLengths['tags'], 'UTF-8');

    if ($deadline_time === '') $deadline_time = null;
    $top_priority = (bool)$top_priority;

    return [$text, $deadline_time, $tags, $top_priority];

}
