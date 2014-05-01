<?php

namespace Schedules;

function requestSecondStage ($day_interval) {

    include_once __DIR__.'/../request_strings.php';
    list($day_offset) = request_strings('day_offset');

    $day_offset = max(0, min($day_interval - 1, abs((int)$day_offset)));

    return [$day_offset];

}
