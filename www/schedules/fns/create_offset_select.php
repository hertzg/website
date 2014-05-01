<?php

function create_offset_select ($day_interval, $value) {

    include_once __DIR__.'/../../fns/time_today.php';
    $timeToday = time_today();

    $options = [
        '0' => 'Today',
        '1' => 'Tomorrow',
    ];

    for ($i = 2; $i < min($day_interval, 7); $i++) {
        $options[$i] = date('l', $timeToday + 60 * 60 * 24 * $i);
    }
    while ($i < $day_interval) {
        $options[$i] = date('j M, l', $timeToday + 60 * 60 * 24 * $i);
        $i++;
    }

    include_once __DIR__.'/../../fns/Form/select.php';
    return Form\select('day_offset', 'Next scheduled day', $options, $value);

}
