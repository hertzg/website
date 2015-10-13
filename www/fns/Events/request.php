<?php

namespace Events;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($event_time, $text) = request_strings('event_time', 'text');

    $parsed_event_time = (int)$event_time;

    include_once "$fnsDir/Events/maxLengths.php";
    $maxLengths = maxLengths();

    include_once "$fnsDir/str_collapse_spaces.php";
    $text = str_collapse_spaces($text);
    $text = mb_substr($text, 0, $maxLengths['text'], 'UTF-8');

    return [$parsed_event_time, $text, $event_time];

}
