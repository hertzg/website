<?php

function format_days_left ($days_left) {

    if ($days_left == 0) return 'Today';

    if ($days_left == 1) return 'Tomorrow';

    include_once __DIR__.'/../../fns/time_today.php';
    $time = time_today() + $days_left * 60 * 60 * 24;

    if ($days_left < 7) $date = date('l', $time);
    else $date = date('M j, l', $time);
    return "$date ($days_left days left)";

}
