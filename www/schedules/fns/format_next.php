<?php

function format_next ($interval, $offset) {

    include_once __DIR__.'/day_offset_from_today.php';
    $offset_from_today = day_offset_from_today($interval, $offset);

    if ($offset_from_today == 0) return 'Today';

    if ($offset_from_today == 1) return 'Tomorrow';

    include_once __DIR__.'/../../fns/time_today.php';
    $time = time_today() + $offset_from_today * 60 * 60 * 24;

    if ($offset_from_today < 7) $next = date('l', $time);
    else $next = date('M j, l', $time);
    $next .= " ($offset_from_today days left)";
    return $next;

}
