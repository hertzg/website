<?php

function format_next ($interval, $offset) {

    include_once __DIR__.'/calculate_next_from_today.php';
    $next = calculate_next_from_today($interval, $offset);

    if ($next == 0) return 'Today';

    if ($next == 1) return 'Tomorrow';

    include_once __DIR__.'/../../fns/time_today.php';
    $time = time_today() + $next * 60 * 60 * 24;

    if ($next < 7) $nextStr = date('l', $time);
    else $nextStr = date('M j, l', $time);
    return "$nextStr ($next days left)";

}
