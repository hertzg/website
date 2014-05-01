<?php

namespace Date;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($year, $month, $day) = request_strings('year', 'month', 'day');

    $year = (int)$year;
    $month = max(1, min(12, (int)$month));
    $day = max(1, min(31, (int)$day));

    return [$year, $month, $day];

}
