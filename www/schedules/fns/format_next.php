<?php

function format_next ($day_interval, $day_offset) {

    include_once __DIR__.'/day_offset_from_today.php';
    $day_offset_from_today = day_offset_from_today($day_interval, $day_offset);

    if ($day_offset_from_today == 0) return 'Today';

    if ($day_offset_from_today == 1) return 'Tomorrow';

    include_once __DIR__.'/../../fns/time_today.php';
    $time = time_today() + $day_offset_from_today * 60 * 60 * 24;

    if ($day_offset_from_today < 7) $next = date('l', $time);
    else $next = date('M j, l', $time);
    $next .= " ($day_offset_from_today days left)";
    return $next;

}
