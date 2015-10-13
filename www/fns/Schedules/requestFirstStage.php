<?php

namespace Schedules;

function requestFirstStage () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($text, $interval) = request_strings('text', 'interval');

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once "$fnsDir/str_collapse_spaces.php";
    $text = str_collapse_spaces($text);
    $text = mb_substr($text, 0, $maxLengths['text'], 'UTF-8');

    include_once __DIR__.'/limits.php';
    $limits = limits();

    $interval = (int)$interval;
    $interval = max($limits['minInterval'], $interval);
    $interval = min($limits['maxInterval'], $interval);

    return [$text, $interval];

}
