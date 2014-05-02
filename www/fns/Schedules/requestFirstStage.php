<?php

namespace Schedules;

function requestFirstStage () {

    include_once __DIR__.'/../request_strings.php';
    list($text, $interval) = request_strings('text', 'interval');

    include_once __DIR__.'/../str_collapse_spaces.php';
    $text = str_collapse_spaces($text);

    include_once __DIR__.'/limits.php';
    $limits = limits();

    $interval = (int)$interval;
    $interval = max($limits['minInterval'], $interval);
    $interval = min($limits['maxInterval'], $interval);

    return [$text, $interval];

}
