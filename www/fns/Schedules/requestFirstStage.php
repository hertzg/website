<?php

namespace Schedules;

function requestFirstStage () {

    include_once __DIR__.'/../request_strings.php';
    list($text, $day_interval) = request_strings('text', 'day_interval');

    include_once __DIR__.'/../str_collapse_spaces.php';
    $text = str_collapse_spaces($text);

    include_once __DIR__.'/limits.php';
    $limits = limits();

    $day_interval = (int)$day_interval;
    $day_interval = max($limits['minInterval'], $day_interval);
    $day_interval = min($limits['maxInterval'], $day_interval);

    return [$text, $day_interval];

}
