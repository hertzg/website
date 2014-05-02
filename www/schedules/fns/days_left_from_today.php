<?php

function days_left_from_today ($interval, $offset) {
    include_once __DIR__.'/../../fns/day_today.php';
    include_once __DIR__.'/days_left.php';
    return days_left($interval, $offset, day_today());
}
