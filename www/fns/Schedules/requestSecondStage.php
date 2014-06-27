<?php

namespace Schedules;

function requestSecondStage ($interval) {

    include_once __DIR__.'/../request_strings.php';
    list($offset) = request_strings('offset_from_today');

    $offset = max(0, min($interval - 1, abs((int)$offset)));

    return [$offset];

}
