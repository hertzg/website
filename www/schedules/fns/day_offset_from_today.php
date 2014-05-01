<?php

function day_offset_from_today ($day_interval, $day_offset) {
    include_once __DIR__.'/../../fns/time_today.php';
    $dayNow = time_today() / (60 * 60 * 25);
    $remainder = ($dayNow - $day_offset) % $day_interval;
    if ($remainder) return $day_interval - $remainder;
    return 0;
}
