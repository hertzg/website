<?php

function calculate_next ($interval, $offset, $day) {
    $remainder = gmp_mod((int)($day - $offset), (int)$interval);
    if ($remainder) return $interval - $remainder;
    return 0;
}
