<?php

namespace Schedules;

function requestFirstStage () {

    include_once __DIR__.'/../request_strings.php';
    list($text, $day_interval) = request_strings('text', 'day_interval');

    include_once __DIR__.'/../str_collapse_spaces.php';
    $text = str_collapse_spaces($text);

    $day_interval = max(2, min(14, abs((int)$day_interval)));

    return [$text, $day_interval];

}
