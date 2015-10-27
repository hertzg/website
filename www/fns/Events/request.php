<?php

namespace Events;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($event_time, $start_hour, $start_minute, $text) = request_strings(
        'event_time', 'start_hour', 'start_minute', 'text');

    $parsed_event_time = (int)$event_time;

    if ($start_hour === '') $start_hour = null;
    else $start_hour = abs((int)$start_hour);

    if ($start_minute === '') $start_minute = null;
    else $start_minute = abs((int)$start_minute);

    if ($start_hour !== null && $start_minute === null) $start_minute = 0;

    include_once "$fnsDir/Events/maxLengths.php";
    $maxLengths = maxLengths();

    include_once "$fnsDir/str_collapse_spaces.php";
    $text = str_collapse_spaces($text);
    $text = mb_substr($text, 0, $maxLengths['text'], 'UTF-8');

    return [$parsed_event_time, $start_hour, $start_minute, $text, $event_time];

}
