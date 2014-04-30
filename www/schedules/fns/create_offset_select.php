<?php

function create_offset_select ($value) {

    include_once __DIR__.'/../../fns/time_today.php';
    $timeToday = time_today();

    include_once __DIR__.'/../../fns/Form/select.php';
    return Form\select('day_offset', 'Start from', [
        '0' => 'Today',
        '1' => 'Tomorrow',
        '2' => date('l', $timeToday + 60 * 60 * 24 * 2),
        '3' => date('l', $timeToday + 60 * 60 * 24 * 3),
        '4' => date('l', $timeToday + 60 * 60 * 24 * 4),
        '5' => date('l', $timeToday + 60 * 60 * 24 * 5),
        '6' => date('l', $timeToday + 60 * 60 * 24 * 6),
    ], $value);

}
