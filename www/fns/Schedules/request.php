<?php

namespace Schedules;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($text, $day_interval, $time_offset) = request_strings(
        'text', 'day_interval', 'time_offset');

    include_once __DIR__.'/../str_collapse_spaces.php';
    $text = str_collapse_spaces($text);

    $day_interval = max(2, min(14, abs((int)$day_interval)));
    $time_offset = max(0, min(6, abs((int)$time_offset)));

    return [$text, $day_interval, $time_offset];

}
