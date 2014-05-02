<?php

function days_left ($interval, $offset, $day) {
    $remainder = ($day - $offset) % $interval;
    if ($remainder < 0) $remainder += $interval;
    if ($remainder) return $interval - $remainder;
    return 0;
}
