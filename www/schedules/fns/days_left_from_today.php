<?php

function days_left_from_today ($interval, $offset) {

    include_once __DIR__.'/../../fns/time_today.php';
    $day = floor(time_today() / (60 * 60 * 24));

    include_once __DIR__.'/days_left.php';
    return days_left($interval, $offset, $day);

}
