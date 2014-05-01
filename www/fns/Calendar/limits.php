<?php

namespace Calendar;

function limits () {

    include_once __DIR__.'/../time_today.php';
    $timeToday = time_today();

    $maxYear = date('Y', $timeToday) + 100;
    $minYear = $maxYear - 100;

    return [
        'maxYear' => $maxYear,
        'minYear' => $minYear,
    ];

}
