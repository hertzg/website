<?php

function day_offset_from_today ($interval, $offset) {

    include_once __DIR__.'/../../fns/time_today.php';
    $day = floor(time_today() / (60 * 60 * 24));

    include_once __DIR__.'/day_offset_from_day.php';
    return day_offset_from_day($interval, $offset, $day);

}
