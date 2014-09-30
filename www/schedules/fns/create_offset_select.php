<?php

function create_offset_select ($user, $interval, $value) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/user_time_today.php";
    $timeToday = user_time_today($user);

    $options = [
        '0' => 'Today',
        '1' => 'Tomorrow',
    ];

    for ($i = 2; $i < min($interval, 7); $i++) {
        $options[$i] = date('l', $timeToday + 60 * 60 * 24 * $i);
    }
    while ($i < $interval) {
        $options[$i] = date('j M, l', $timeToday + 60 * 60 * 24 * $i);
        $i++;
    }

    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/select.php";
    return Form\select('offset_from_today', 'Next', $options, $value)
        .Form\notes(['The next day when the schedule is effective.']);

}
