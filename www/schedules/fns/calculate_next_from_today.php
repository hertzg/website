<?php

function calculate_next_from_today ($interval, $offset) {

    include_once __DIR__.'/../../fns/time_today.php';
    $day = floor(time_today() / (60 * 60 * 24));

    include_once __DIR__.'/calculate_next.php';
    return calculate_next($interval, $offset, $day);

}
