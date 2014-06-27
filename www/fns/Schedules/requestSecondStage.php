<?php

namespace Schedules;

function requestSecondStage ($interval) {
    include_once __DIR__.'/../request_strings.php';
    list($days_left) = request_strings('offset_from_today');
    return max(0, min($interval - 1, abs((int)$days_left)));
}
