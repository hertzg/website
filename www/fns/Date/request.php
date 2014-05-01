<?php

namespace Date;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($day, $month, $year) = request_strings('day', 'month', 'year');

    $day = max(1, min(31, (int)$day));
    $month = max(1, min(12, (int)$month));
    $year = (int)$year;

    return [$day, $month, $year];

}
